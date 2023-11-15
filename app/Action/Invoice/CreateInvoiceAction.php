<?php

namespace App\Action\Invoice;

use App\Events\InvoiceCreatedEvent;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Item;
use DB;
use Exception;

class CreateInvoiceAction
{
    function handle(StoreInvoiceRequest $request): ?InvoiceResource
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();

            $invoice = Invoice::create([
                'customer_id' => $validatedData['customerId'],
                'issue_date' => $validatedData['issueDate'],
                'due_date' => $validatedData['dueDate'],
            ]);

            $items = $validatedData['items'];
            foreach ($items as $item) {
                $amount = $item['quantity'] * $item['price'];

                $invoice->items()->attach( $item['itemId'],[
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'amount' => $amount,
                    'description' => $item['description'],
                ]);
            }

            $invoiceTotal = $invoice->items()->sum('amount');

            $invoice->update(['total' => $invoiceTotal]);

            event(new InvoiceCreatedEvent($invoice));

            DB::commit();

            return new InvoiceResource($invoice->load('items', 'customer'));
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
        }
        return null;
    }
}
