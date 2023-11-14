<?php

namespace App\Action\Customer;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Exception;

class StoreCustomerAction
{
    function handle(StoreCustomerRequest $request): ?Customer
    {
        try {
            $data = $request->validated();
            return Customer::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);
        }catch (Exception $e) {
           report($e);
        }
        return null;
    }

}
