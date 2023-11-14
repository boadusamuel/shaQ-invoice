<?php

namespace App\Listeners;

use App\Events\InvoiceItemCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoiceItemCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(InvoiceItemCreatedEvent $event): void
    {
        $invoiceItem = $event->invoiceItem;

        $itemQuantity = $invoiceItem->quantity;

        $item = $invoiceItem->item;

        $item->decrement('quantity', $itemQuantity);
    }
}
