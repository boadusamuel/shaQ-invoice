<?php

namespace App\Action\Customer;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Exception;

class CreateCustomerAction
{
    function handle(StoreCustomerRequest $request): ?CustomerResource
    {
        try {
            $data = $request->validated();
            $customer = Customer::create($data);
            return new CustomerResource($customer);
        }catch (Exception $exception) {
           report($exception);
        }
        return null;
    }

}
