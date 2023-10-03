<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InvoiceController extends Controller
{
    public function download(Request $request)
    {
        $order   = Order::byOrderId($request->order);
        $invoice = Invoice::where('invoice_for', $request->for)->where('id', $request->invoice_id)->first();

        if (! $invoice) {
            return 'Invoice not yet ready.';
        }
        // If customer changes url from customer to booster. We don't want to show invoice for booster.
        if ($request->for == 'booster' && !auth()->user()->hasRole('admin') && !$order->isThisAssignedBooster(auth()->id())) {
            abort(404);
        }
        $invoice->created_at = $invoice->order->created_at;
        $pdf = PDF::loadView('panel.orders.invoice', [
            'invoice' => $invoice,
        ]);

        return $pdf->stream();
    }
}
