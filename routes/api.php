<?php

use App\Http\Controllers\PayPalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/paypal/create-payment", [PayPalController::class, "create_payment"])->name("paypal.create_payment");
Route::post("/paypal/execute-payment", [PayPalController::class, "execute_payment"])->name("paypal.execute_payment");
