<?php

use App\Http\Controllers\MolliePaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* PAYPAL */
Route::get('/client-side-pay-pal', function () {
    return view("client_side_pay_pal");
})->name('paypal.client_side');

Route::get('/server-side-pay-pal', function () {
    return view("server_side_pay_pal");
})->name('paypal.server_side');
/*/////////////////////////////////////////////////////////////////////////////////////*/

/* MOLLIE */
Route::get('/mollie/checkout', function () {
    return view("mollie_checkout");
})->name('mollie.checkout');
Route::get('/mollie/payment', [MolliePaymentController::class, "payment"])->name('mollie.payment');
Route::get('/mollie/webhook', [MolliePaymentController::class, "handleWebhookNotification"])->name('mollie.webhook');
/*/////////////////////////////////////////////////////////////////////////////////////*/

/* STRIPE */
Route::get('/stripe/checkout', function () {
    $paymentIntent = auth()->user()->createSetupIntent();
    return view("stripe_checkout", [
        "paymentIntent" => $paymentIntent
    ]);
})->name('stripe.checkout');
Route::post('/stripe/payment', [StripePaymentController::class, "payment"])->name('stripe.payment');
Route::post('/stripe/webhook', [StripePaymentController::class, "webhookHandler"])->name('stripe.webhook');  
 
/*/////////////////////////////////////////////////////////////////////////////////////*/