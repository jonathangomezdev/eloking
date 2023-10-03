<?php

namespace App\Console\Commands;

use App\Events\InvoiceRegenerateEvent;
use App\Invoice;
use Illuminate\Console\Command;

class NewInvoiceStructureWithOldInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:invoice:convert-existing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will convert to new structure of invoice';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Loading all invoices");
        $invoices = Invoice::with('order')->get();

        $this->info("Found {$invoices->count()} invoices to be moved to new structure");

        $alreadyProcessedOrders = [];
        foreach ($invoices as $invoice) {
            $this->migrate($invoice, $alreadyProcessedOrders);
            $alreadyProcessedOrders[$invoice->order_id] = true;
            $this->info("Migration completed.");
        }

        $this->info("Congratulation, All invoices migrated. Total: " . $invoices->count());
        return 0;
    }

    private function restructureInvoice($order)
    {
        event(new InvoiceRegenerateEvent($order));
    }

    private function migrate($invoice, $alreadyProcessedOrders)
    {
        if (isset($alreadyProcessedOrders[$invoice->order_id])) {
            $this->info('invoice for this order already created. Skipping...');
            $invoice->update([
                'deleted_at' => now()
            ]);
            return;
        }
        $this->info("Migrating invoice id #{$invoice->id}");
        $this->restructureInvoice($invoice->order);
        $invoice->update([
            'deleted_at' => now()
        ]);
    }
}
