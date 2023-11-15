<?php

namespace App\Action\Invoice;

use App\Events\InvoiceItemsUpdatedEvent;
use App\Http\Requests\UpdateInvoiceItemsRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Item;
use DB;
use Exception;

class UpdateInvoiceItemsAction
{
    function handle(UpdateInvoiceItemsRequest $request, Invoice $invoice): ?InvoiceResource
    {
        try {
            DB::beginTransaction();
            $items = $request->validated()['items'];

            $oldQuantities = $invoice->items()->pluck('invoice_items.quantity', 'item_id')->toArray();

            foreach ($oldQuantities as $itemId => $oldQuantity) {
                $item = Item::find($itemId);
                $item->increment('quantity', $oldQuantity);
            }

            $itemsToSync = [];

            foreach ($items as $item) {
                $amount = $item['quantity'] * $item['price'];

                $itemsToSync[$item['itemId']] = [
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'amount' => $amount,
                    'description' => $item['description'],
                ];
            }

            $invoice->items()->sync($itemsToSync);

            $invoiceTotal = $invoice->items()->sum('amount');
            $invoice->update(['total' => $invoiceTotal]);

            event(new InvoiceItemsUpdatedEvent($invoice));

            DB::commit();

            return new InvoiceResource($invoice->load('items', 'customer'));
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
