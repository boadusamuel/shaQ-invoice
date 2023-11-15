<?php

namespace App\Action\Item;

use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;

class CreateItemAction
{
    function handle(StoreItemRequest $request): ?ItemResource
    {
        try {
            $data = $request->validated();
            $item = Item::create($data);
            return new ItemResource($item);
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }

}
