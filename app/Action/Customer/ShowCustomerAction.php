<?php

namespace App\Action\Customer;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Exception;

class ShowCustomerAction
{
    function handle(Customer $customer): ?CustomerResource
    {
        try {
            return new CustomerResource($customer);
        }catch (Exception $e) {
            report($e);
        }
        return null;
    }
}
