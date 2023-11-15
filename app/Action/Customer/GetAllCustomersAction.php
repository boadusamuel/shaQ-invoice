<?php

namespace App\Action\Customer;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllCustomersAction
{
    function handle(Request $request): ?AnonymousResourceCollection
    {
        try {
            $perPage = $request->input('perPage', 20);
            $page = $request->input('page', 1);
            $name = $request->input('name');

            $customers = Customer::query()
                ->when($name, function ($query, $name) {
                    $query->where('name', 'like', "%{$name}%");
                })
                ->paginate($perPage, ['*'], 'page', $page);

            return CustomerResource::collection($customers);
        } catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
