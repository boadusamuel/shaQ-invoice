<?php

namespace App\Action\Item;

use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;

class UpdateItemAction
{
    function handle(Item $item, UpdateItemRequest $request): ?ItemResource
    {
        try {
            $data = $request->validated();
            $item->update($data);
            return new ItemResource($item);
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
