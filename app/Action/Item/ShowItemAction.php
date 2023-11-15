<?php

namespace App\Action\Item;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;

class ShowItemAction
{
    function handle(Item $item): ?ItemResource
    {
        try {
            return new ItemResource($item);
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
