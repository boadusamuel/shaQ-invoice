<?php

namespace App\Observers;

use App\Events\InvoiceItemCreatedEvent;
use App\Models\InvoiceItem;

class InvoiceItemObserver
{
    /**
     * Handle the InvoiceItem "created" event.
     */
    public function created(InvoiceItem $invoiceItem): void
    {
        event(new InvoiceItemCreatedEvent($invoiceItem));
    }
}
