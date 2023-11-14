<?php

use Illuminate\Http\JsonResponse;

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
