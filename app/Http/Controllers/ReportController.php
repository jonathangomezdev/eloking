<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! (auth()->user()->hasRole('admin') || auth()->user()->hasRole('accountant')), 404);

        if ($request->dates) {
            $startDate = Carbon::parse(explode(' - ', $request->dates)[0]);
            $endDate = Carbon::parse(explode(' - ', $request->dates)[1]);

            $orderIds = Order::select('id')->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();
            $query = Invoice::whereIn('order_id', $orderIds->pluck('id')->toArray())->with('order');
            switch ($request['invoice-type']) {
                case 'eloking':
                    $query->where('invoice_from', 'eloking');
                    break;
                case 'customer':
                    $query->where('invoice_from', 'booster');
                    break;
            }
            $invoices = $query->get();

            if ($invoices->count()) {
                File::ensureDirectoryExists(storage_path('temp/invoices'));

                $invoices->each(function($invoice) {
                    $invoice->created_at = $invoice->order->created_at;
                    $filename = storage_path('temp/invoices/order-' . $invoice->order->order_id . '-' . $invoice->id . '-invoice.pdf');
                    PDF::loadView('panel.orders.invoice', [
                        'invoice' => $invoice,
                    ])->save($filename);
                });

                File::delete(glob(public_path('eloking-invoices-*.zip')));
                $filename = 'eloking-invoices-' . uniqid() . '.zip';

                $zip = \Zip::create($filename);
                $zip->add(storage_path('temp/invoices'));
                $zip->close();

                $response = response()->download(public_path($filename));

                File::deleteDirectory(storage_path('temp/invoices'));
                return $response;
            }
        }
        return view('panel.admin.report.index');
    }
}
