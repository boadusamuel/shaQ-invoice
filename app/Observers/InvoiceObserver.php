<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function creating(Invoice $invoice): void
    {
        $invoice->code = $invoice->generateCode();
    }
}
