<?php

namespace App\Http\Controllers;

use App\Action\Customer\StoreCustomerAction;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request, StoreCustomerAction $action)
    {
      $customer = $action->handle($request);

      if ($customer){
          return successResponse($customer, 201);
      }
      return errorResponse();
    }
}
