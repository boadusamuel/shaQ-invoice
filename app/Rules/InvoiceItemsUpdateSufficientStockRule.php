<?php

namespace App\Rules;

use App\Models\Invoice;
use App\Models\Item;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class InvoiceItemsUpdateSufficientStockRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $invoice = Invoice::find(request()->route('invoice')->id);

        $oldQuantities = $invoice->items()->pluck('invoice_items.quantity', 'item_id')->toArray();

        foreach ($value as $purchaseItem) {
            $item = Item::find($purchaseItem['itemId']);

            $oldQuantity = collect($oldQuantities)->value($item->id) ?? 0;

            $newQuantity = $item->quantity + $oldQuantity;

            if (!($newQuantity >= $purchaseItem['quantity'])) {
                $fail('Insufficient stock for the selected item with ItemId: ' . $item->id . '. Available Stock: ' . $newQuantity);
            };
        }
    }
}
