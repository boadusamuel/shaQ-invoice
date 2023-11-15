<?php

namespace App\Action\Invoice;

use App\Models\Invoice;
use App\Models\Item;
use DB;
use Exception;

class DeleteInvoiceAction
{
    function handle(Invoice $invoice): bool
    {
        try {
            DB::beginTransaction();
            $oldQuantities = $invoice->items()->pluck('invoice_items.quantity', 'item_id')->toArray();

            foreach ($oldQuantities as $itemId => $oldQuantity) {
                $item = Item::find($itemId);
                $item->increment('quantity', $oldQuantity);
            }

            $invoice->items()->detach();

            $invoice->delete();
            DB::commit();
            return true;
        }catch (Exception $exception) {
            report($exception);
            DB::rollBack();
        }
        return false;
    }
}
