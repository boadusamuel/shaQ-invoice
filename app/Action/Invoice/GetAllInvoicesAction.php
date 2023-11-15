<?php

namespace App\Action\Invoice;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllInvoicesAction
{
    function handle(Request $request): ?AnonymousResourceCollection
    {
        try {
            $perPage = $request->input('perPage', 20);
            $page = $request->input('page', 1);
            $customerId = $request->input('customerId');

            $invoices = Invoice::query()
                ->when($customerId, function ($query, $customerId) {
                    $query->where('customer_id', $customerId);
                })
                ->paginate($perPage, ['*'], 'page', $page);
            return InvoiceResource::collection($invoices);
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
