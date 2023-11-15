<?php

namespace App\Listeners;

use App\Events\InvoiceItemsUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoiceItemsUpdatedListener
{
    /**
     * Handle the event.
     */
    public function handle(InvoiceItemsUpdatedEvent $event): void
    {
        $invoice = $event->invoice;

        reduceInvoiceItemStocks($invoice);
    }
}
