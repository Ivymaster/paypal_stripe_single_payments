<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripePaymentController extends Controller
{
    public function payment(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->charge(
            100,
            $paymentMethod
        );
        return redirect()->route("home");
    }
    public function webhook(Request $request)
    {
        Log::info("Stripe w r");
    }
}
