<?php

namespace App\Listeners;

use App\Events\InvoiceCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoiceCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(InvoiceCreatedEvent $event): void
    {
        $invoice = $event->invoice;

        reduceInvoiceItemStocks($invoice);
    }
}
