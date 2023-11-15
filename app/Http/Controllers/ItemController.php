<?php

namespace App\Http\Controllers;

use App\Action\Item\AddItemQuantityAction;
use App\Action\Item\CreateItemAction;
use App\Action\Item\GetAllItemsAction;
use App\Action\Item\ShowItemAction;
use App\Action\Item\UpdateItemAction;
use App\Http\Requests\AddItemQuantityRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetAllItemsAction $action)
    {
        $items = $action->handle($request);

        if ($items){
            return paginatedSuccessResponse($items);
        }
        return errorResponse();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request, CreateItemAction $action)
    {
        $item = $action->handle($request);

        if ($item){
            return successResponse($item);
        }
        return errorResponse();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addItemQuantity(Item $item, AddItemQuantityRequest $request, AddItemQuantityAction $action)
    {
        $item = $action->handle($item, $request);

        if ($item){
            return successResponse($item);
        }
        return errorResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item, UpdateItemAction $action)
    {
        $item = $action->handle($item, $request);

        if ($item){
            return successResponse($item);
        }
        return errorResponse();
    }

    public function show(Item $item, ShowItemAction $action)
    {
        $item = $action->handle($item);

        if ($item){
            return successResponse($item);
        }
        return errorResponse();
    }
}
