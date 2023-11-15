<?php

namespace App\Action\Item;

use App\Http\Requests\AddItemQuantityRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;

class AddItemQuantityAction
{
    function handle(Item $item, AddItemQuantityRequest $request): ?ItemResource
    {
        try {
            $data = $request->validated();
             $item->increment('quantity', $data['quantity']);
             $item->save();
             return new ItemResource($item);
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
