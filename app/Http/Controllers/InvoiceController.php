<?php

namespace App\Http\Controllers;

use App\Action\Invoice\CreateInvoiceAction;
use App\Action\Invoice\GetAllInvoicesAction;
use App\Action\Invoice\ShowInvoiceAction;
use App\Action\Invoice\UpdateInvoiceAction;
use App\Action\Invoice\UpdateInvoiceItemsAction;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceItemsRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetAllInvoicesAction $action)
    {
        $invoices = $action->handle($request);

        if ($invoices){
            return paginatedSuccessResponse($invoices);
        }
        return errorResponse();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request, CreateInvoiceAction $action)
    {
        $invoice = $action->handle($request);

        if ($invoice){
            return successResponse($invoice);
        }
        return errorResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice, ShowInvoiceAction $action)
    {
        $invoice = $action->handle($invoice);

        if ($invoice){
            return successResponse($invoice);
        }
        return errorResponse();
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice, UpdateInvoiceAction $action){
        $invoice = $action->handle($invoice, $request);

        if ($invoice){
            return successResponse($invoice);
        }
        return errorResponse();
    }

    public function updateInvoiceItems(UpdateInvoiceItemsRequest $request, Invoice $invoice, UpdateInvoiceItemsAction $action){
        $invoice = $action->handle($request, $invoice);

        if ($invoice){
            return successResponse($invoice);
        }
        return errorResponse();
    }
}
