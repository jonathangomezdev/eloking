<?php

namespace App\Listeners;

use App\BoosterOrder;
use App\Events\InvoiceGeneratedEvent;
use App\Invoice;
use App\InvoiceItem;
use App\Order;
use App\Service\BoosterPayoutService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;

class GenerateInvoiceListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        File::ensureDirectoryExists(storage_path('app/public/invoices'));
        if ($event->order->isDropped()) {
            $boosterOrder = BoosterOrder::where('order_id', $event->order->id)->whereNotNull('drop_comment')->first();
            $payout = BoosterPayoutService::calculateOrderPayout($event->order, $boosterOrder->booster_id);

            $totalEarningPercent = ($payout / $event->order->booster_earning_EUR) * 100;
            $orderTotal = ($event->order->total_EUR / 100) * $totalEarningPercent;

            $this->generateBoosterCustomerInvoice($event->order, $boosterOrder->booster, $payout, $orderTotal);
            $this->generateElokingBoosterInvoice($event->order, $boosterOrder->booster, $payout, $orderTotal);

            $orderTotal = ($event->order->total_EUR / 100) * (100 - $totalEarningPercent);

            $booster = $event->order->booster();
            $this->generateBoosterCustomerInvoice($event->order, $booster, $event->order->booster_earning_EUR - $payout, $orderTotal);
            $this->generateElokingBoosterInvoice($event->order, $booster, $event->order->booster_earning_EUR - $payout, $orderTotal);
        } else {
            $this->generateBoosterCustomerInvoice($event->order, $event->order->booster(), $event->order->booster_earning_EUR, $event->order->total_EUR);
            $this->generateElokingBoosterInvoice($event->order, $event->order->booster(), $event->order->booster_earning_EUR, $event->order->total_EUR);
        }
    }

    /**
     * It will generate invoice for customer from booster
     * @param Order $order
     * @return void
     */
    private function generateBoosterCustomerInvoice(Order $order, $booster, $boosterEarning, $orderTotal)
    {
        $customer = $order->user;
        $invoiceNumber = $this->generateInvoiceNumber($order->order_id);


        if (! $booster) {
            return;
        }

        if ($booster->vat_rate) {
            $subtotal = round($orderTotal - (($orderTotal / 100) * $booster->vat_rate), 2);
        } else {
            $subtotal = round($orderTotal, 2);
        }

        $invoiceData = [
            'invoice_from' => 'booster',
            'invoice_for' => 'customer',
            'invoice_number' => $invoiceNumber,
            'title' => 'Boosting service fee',
            'vendor_company' => $booster->company_name ?? '',
            'vendor_name' => $booster->name,
            'vendor_street' => $booster->street ?? '',
            'vendor_city' => $booster->city ?? '',
            'vendor_state' => $booster->state ?? '',
            'vendor_country' => $booster->country ?? '',
            'vendor_postcode' => $booster->postcode ?? '',
            'vendor_vat_number' => $booster->vat_number ?? '',
            'vendor_vat_rate' => $booster->vat_rate,
            'customer_name' => $customer->name,
            'customer_country' => $customer->country,
            'description' => 'Provided boosting service for order no. #' . $order->order_id,
            'subtotal' => $subtotal,
            'total' => $orderTotal,
            'note' => '',
            'order_id' => $order->id,
            'vendor_id' => $booster->id,
            'customer_id' => $customer->id,
        ];

        if ($booster->vat_rate) {
            $invoiceData['vat_amount'] = $this->calculateVat($orderTotal, $booster->vat_rate);
        }

        $invoice = Invoice::create(array_merge($invoiceData, [
            'invoice_number' => $invoiceNumber,
            'invoice_from' => 'booster',
            'invoice_for'  => 'customer',
            'order_id' => $order->id,
        ]));

        $items = collect();

        $items->push($this->addBasicItem($order, $booster, $orderTotal, $invoice));

        if (! $order->isOrderDropper($booster->id) && $order->totalTip() > 0) {
            $items->push($this->addTipItem($order, $invoice));
        }

        $invoice->update([
            'subtotal' => $items->sum('total'),
            'total' => $items->sum('total') + ($booster->vat_rate ? $this->calculateVat($orderTotal, $booster->vat_rate) : 0)
        ]);
    }

    private function addBasicItem(Order $order, $booster, $orderTotal, Invoice $invoice)
    {
        $price = $orderTotal;
        if ($booster->vat_rate) {
            $price = $orderTotal - $this->calculateVat($orderTotal, $booster->vat_rate);
        }

        return InvoiceItem::create([
            'item_number' => 1,
            'description' => 'Provided boosting service for order no. #' . $order->order_id,
            'qty' => 1,
            'unit_price' => $price,
            'total' => $price,
            'invoice_id' => $invoice->id,
        ]);
    }

    private function addTipItem(Order $order, Invoice $invoice)
    {
        return InvoiceItem::create([
            'item_number' => 2,
            'description' => 'Tip for order #' . $order->order_id,
            'qty' => 1,
            'unit_price' => $order->totalTip($order->isEUR(), false),
            'total' => $order->totalTip($order->isEUR(), false),
            'invoice_id' => $invoice->id,
        ]);
    }

    /**
     * It will generate invoice from eloking to booster
     * @param Order $order
     * @return void
     */
    private function generateElokingBoosterInvoice(Order $order, $customer, $boosterEarning, $orderTotal)
    {
        $eloking = config('eloking');

        if (! $customer) {
            return;
        }

        $invoiceNumber = $this->generateInvoiceNumber($order->order_id . '-EK1');

        $invoiceData = [
            'invoice_from' => 'eloking',
            'invoice_for' => 'booster',
            'invoice_number' => $invoiceNumber,
            'title' => 'Eloking Platform Usage Fee',
            'vendor_company' => $eloking['company_name'],
            'vendor_name' => $eloking['name'],
            'vendor_street' => $eloking['street'],
            'vendor_city' => $eloking['city'],
            'vendor_state' => $eloking['state'],
            'vendor_country' => $eloking['country'],
            'vendor_postcode' => $eloking['postcode'],
            'vendor_vat_number' => $eloking['vat_number'],
            'vendor_vat_rate' => $eloking['vat_rate'],
            'customer_name' => $customer->name,
            'customer_country' => $customer->country,
            'description' => 'Eloking platform usage free for order no. #' . $order->order_id,
            'subtotal' => 0,
            'total' => 0,
            'note' => '',
            'order_id' => $order->id,
            'vat_amount' => $this->calculateVat($this->getPlatformUsageFee($boosterEarning, $orderTotal), config('eloking.vat_rate')),
            'vendor_id' => 0,
            'customer_id' => $customer->id,
        ];

        $invoice = Invoice::create(array_merge($invoiceData, [
            'invoice_number' => $invoiceNumber,
            'invoice_from' => 'eloking',
            'invoice_for'  => 'booster',
            'order_id' => $order->id,
        ]));

        $items = collect();
        $items->push($this->addPlatformUsageItem($order, $boosterEarning, $orderTotal, $invoice));

        $grandTotal = $this->getPlatformUsageFee($boosterEarning, $orderTotal);
        if ($order->totalTip() > 0) {
            $tipEntry = $this->addTipFeeItem($order, $invoice);
            $items->push($tipEntry);
            $grandTotal += $order->totalTip(true, false) * 0.05;
        }

        $invoice->update([
            'subtotal' => $items->sum('total'),
            'vat_amount' => $this->calculateVat($grandTotal, config('eloking.vat_rate')),
            'total' => $grandTotal,
        ]);
    }

    private function addPlatformUsageItem(Order $order, $boosterEarning, $orderTotal, Invoice $invoice)
    {
        return InvoiceItem::create([
            'item_number' => 1,
            'description' => 'Eloking platform usage free for order no. #' . $order->order_id,
            'qty' => 1,
            'unit_price' => $this->getPlatformUsageFeeAfterVat($boosterEarning, $orderTotal),
            'total' => $this->getPlatformUsageFeeAfterVat($boosterEarning, $orderTotal),
            'invoice_id' => $invoice->id,
        ]);
    }

    private function addTipFeeItem(Order $order, Invoice $invoice)
    {
        $tip = $order->totalTip(true, false);
        $tipFee = $tip * 0.05;
        $price = round($tipFee - $this->calculateVat($tipFee, config('eloking.vat_rate')), 2);
        return InvoiceItem::create([
            'item_number' => 2,
            'description' => 'Processing fee for tip ' . currencyFormatted($tip, 'eur', true) . ' for order #' . $order->order_id,
            'qty' => 1,
            'unit_price' => $price,
            'total' => $price,
            'invoice_id' => $invoice->id,
        ]);
    }

    private function getPlatformUsageFee($boosterEarning, $orderTotal)
    {
        return $orderTotal - $boosterEarning;
    }

    private function getPlatformUsageFeeAfterVat($boosterEarning, $orderTotal)
    {
        $fee = $this->getPlatformUsageFee($boosterEarning, $orderTotal);

        return ($fee - $this->calculateVat($fee, config('eloking.vat_rate')));
    }

    private function calculateVat($amount, $vatRate)
    {
        $vatRate = (float)('1.' . $vatRate);
        return round(($amount - ($amount / $vatRate)), 2);
    }

    private function generateInvoiceNumber($proposedNumber)
    {
        $invoiceNumber = $proposedNumber;
        $count = 1;
        while(Invoice::where('invoice_number', $invoiceNumber)->exists()) {
            $invoiceNumber = $proposedNumber . $count;
            $count++;
        }

        return $invoiceNumber;
    }
}
