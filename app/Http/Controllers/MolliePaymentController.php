<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MolliePaymentController extends Controller
{
    public function payment()
    {

        $payment =  \Mollie\Laravel\Facades\Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "1.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "redirectUrl" => route('home'),
            "webhookUrl" => route('mollie.webhook'),
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleWebhookNotification(Request $request)
    {
        $paymentId = $request->input('id');
        $payment =  \Mollie\Laravel\Facades\Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid()) {
            echo 'Payment received.';
            // Do your thing ...
        }
    }
}
