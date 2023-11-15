<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1.0')->group(function () {

    Route::post('/login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('items', ItemController::class)->except('destroy');

        Route::put('items/{item}/increment-quantity', [ItemController::class, 'addItemQuantity'])
            ->name('items.incrementQuantity');

        Route::apiResource('invoices', InvoiceController::class);

        Route::put('invoices/{invoice}/items', [InvoiceController::class, 'updateInvoiceItems'])
            ->name('invoices.updateItems');

        Route::apiResource('customers', CustomerController::class)->only(['index', 'show', 'store']);

        Route::post('/logout', [UserController::class, 'logout']);
    });
});


