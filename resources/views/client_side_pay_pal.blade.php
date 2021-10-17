@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
                <script
                                src="https://www.paypal.com/sdk/js?client-id=AWrn9OR4lDBEcwfjoR8DioBXfsvtWrBOOFkuw_jiMA59ZapLrlrcCgSSJleEqjRuvgm9Bt9oLWSQLRJD&currency=USD">
                </script>
                <div class="row">
                    <div class="col-12 text-center">
                        Clien side - Donate 50 &euro; (just a test payment)
                    </div>
                </div>
                <!-- Set up a container element for the button -->
                <div id="paypal-button-container" class="m-5"></div>

                <script>
                    paypal.Buttons({

                        // Sets up the transaction when a payment button is clicked
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '50' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                    }
                                }]
                            });
                        },

                        // Finalize the transaction after payer approval
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(orderData) {
                                // Successful capture! For dev/demo purposes:
                                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                var transaction = orderData.purchase_units[0].payments.captures[0];
                                alert('Transaction ' + transaction.status + ': ' + transaction.id +
                                    '\n\nSee console for all available details');

                                // When ready to go live, remove the alert and show a success message within this page. For example:
                                // var element = document.getElementById('paypal-button-container');
                                // element.innerHTML = '';
                                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                // Or go to another URL:  actions.redirect('thank_you.html');
                            });
                        }
                    }).render('#paypal-button-container');
                </script>
            </div>
        </div>
    </div>
@endsection
