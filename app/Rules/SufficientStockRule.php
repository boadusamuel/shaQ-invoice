<?php

namespace App\Rules;

use App\Models\Item;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Validation\Validator;

class SufficientStockRule implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         foreach ($value as $purchaseItem){
             $item = Item::find($purchaseItem['itemId']);

             $currentQuantity = $item->quantity;

             if(!($currentQuantity >= $purchaseItem['quantity'])){
                 $fail('Insufficient stock for the selected item with ItemId: '.$item->id  . '. Available Stock: ' . $currentQuantity);
             };
         }
    }
}
