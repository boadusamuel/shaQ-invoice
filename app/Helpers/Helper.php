<?php

use App\Models\Invoice;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

function successResponse($data, $status = 200): JsonResponse
{
    return response()->json([
        'success' => true,
        'data' => $data
    ], $status);
}

function errorResponse($message = 'Something went wrong', $code = 500): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message
    ], $code);
}

function paginatedSuccessResponse($data = [], int $statusCode = 200, $message = ''): Application|ResponseFactory|\Illuminate\Http\Response
{
    $responseData = $data->response()->getData();

    $extra = [
        'additional' => null,
    ];

    if ($message) {
        $extra['message'] = $message;
    }

    if ($data->additional) {
        $extra['additional'] = $data->additional['additional'];
    }

    return response([
        'success' => true,
        'data' => $data->items(),
        'links' => optional($responseData)->links,
        'meta' => optional($responseData)->meta,
        ...$extra,
    ], $statusCode);
}

function formatNumber($number, $decimal = 2): string
{
 return number_format($number, $decimal);
}

function reduceInvoiceItemStocks(Invoice $invoice): void
{
    $invoiceItems = $invoice->items;

    foreach ($invoiceItems as $item) {

        $itemQuantity = $item->pivot->quantity;

        $item->decrement('quantity', $itemQuantity);
    }
}
