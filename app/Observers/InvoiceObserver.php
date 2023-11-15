<?php

namespace App\Observers;

use App\Events\InvoiceCreatedEvent;
use App\Models\Invoice;

class InvoiceObserver
{
    /**
     * Handle the Invoice "creating" event.
     */
    public function creating(Invoice $invoice): void
    {
        $invoice->number = $invoice->generateCode();
    }
}
