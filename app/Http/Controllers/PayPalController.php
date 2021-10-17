<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Payments\AuthorizationsCaptureRequest;

class PayPalController extends Controller
{
    public function create_payment()
    {
        // Creating an environment
        $clientId = "AWrn9OR4lDBEcwfjoR8DioBXfsvtWrBOOFkuw_jiMA59ZapLrlrcCgSSJleEqjRuvgm9Bt9oLWSQLRJD";
        $clientSecret =  "EDyyWq6vBwrTGy5uvoAi3dtpGYyzEUyODpFQM9IQBQAxwfrPz492Pt2OcwNHS4d8ry_fO74jiKSjgeJg";
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = array(
            'intent' => 'CAPTURE',
            'application_context' =>
            array(
                'return_url' => 'https://checknrecheck.com/home',
                'cancel_url' => 'https://checknrecheck.com/home'
            ),
            'purchase_units' =>
            array(
                0 =>
                array(
                    'amount' =>
                    array(
                        'currency_code' => 'USD',
                        'value' => '1.00'
                    )
                )
            )
        );

        $response = $client->execute($request);
        return response()->json($response);
    }
    public function execute_payment(Request $request)
    {
        $clientId = "AWrn9OR4lDBEcwfjoR8DioBXfsvtWrBOOFkuw_jiMA59ZapLrlrcCgSSJleEqjRuvgm9Bt9oLWSQLRJD";
        $clientSecret =  "EDyyWq6vBwrTGy5uvoAi3dtpGYyzEUyODpFQM9IQBQAxwfrPz492Pt2OcwNHS4d8ry_fO74jiKSjgeJg";
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        $paypal_request = new AuthorizationsCaptureRequest($request->order_id);
        $paypal_request->body = array(
            'intent' => 'AUTHORIZE',
            'application_context' =>
            array(
                'return_url' => 'https://checknrecheck.com/home',
                'cancel_url' => 'https://checknrecheck.com/home'
            ),
            'purchase_units' =>
            array(
                0 =>
                array(
                    'amount' =>
                    array(
                        'currency_code' => 'USD',
                        'value' => '1.00'
                    )
                )
            )
        );
        // 3. Call PayPal to capture an authorization. 
        $response = $client->execute($paypal_request);
        return response()->json($response);
    }
}
