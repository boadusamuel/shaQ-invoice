<?php

namespace App\Http\Controllers;

use App\Action\Customer\CreateCustomerAction;
use App\Action\Customer\GetAllCustomersAction;
use App\Action\Customer\ShowCustomerAction;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request, GetAllCustomersAction $action){
        $customers = $action->handle($request);

        if ($customers){
            return paginatedSuccessResponse($customers);
        }
        return errorResponse();
    }

    public function show(Customer $customer, ShowCustomerAction $action){
        $customer = $action->handle($customer);

        if ($customer){
            return successResponse($customer);
        }
        return errorResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request, CreateCustomerAction $action)
    {
      $customer = $action->handle($request);

      if ($customer){
          return successResponse($customer, 201);
      }
      return errorResponse();
    }
}
