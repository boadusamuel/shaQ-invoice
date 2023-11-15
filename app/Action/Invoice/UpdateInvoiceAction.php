<?php

namespace App\Action\Invoice;

use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Exception;

class UpdateInvoiceAction
{
    function handle(Invoice $invoice, UpdateInvoiceRequest $request): ?InvoiceResource
    {
        try {
            $validatedData = $request->validated();

            $invoice->update(
                [
                    'customer_id' => $validatedData['customerId'],
                    'issue_date' => $validatedData['issueDate'],
                    'due_date' => $validatedData['dueDate'],
                ]
            );

            return new InvoiceResource($invoice->load('items', 'customer'));
        } catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
