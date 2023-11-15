<?php

namespace App\Action\Invoice;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Exception;

class ShowInvoiceAction
{
    function handle(Invoice $invoice): ?InvoiceResource
    {
        try {
            return new InvoiceResource($invoice->load('items', 'customer'));
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
