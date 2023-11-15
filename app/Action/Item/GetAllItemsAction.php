<?php

namespace App\Action\Item;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllItemsAction
{
    function handle(Request $request): ?AnonymousResourceCollection
    {
        try {
            $perPage = $request->input('perPage', 20);
            $page = $request->input('page', 1);
            $name = $request->input('name');

            $items = Item::query()
                ->when($name, function ($query, $name) {
                    $query->where('name', 'like', "%{$name}%");
                })
                ->paginate($perPage, ['*'], 'page', $page);

            return ItemResource::collection($items);
        } catch (Exception $exception) {
            report($exception);
        }
        return null;
    }

}
