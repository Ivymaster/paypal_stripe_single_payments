@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Display a payment form -->
                <form id="payment-form" action="{{ route('stripe.payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" id="payment-method">
                    <div id="card-element">
                        <!--Stripe.js injects the Card Element-->
                    </div>
                    <button id="button-submit" type="button" class="btn btn-primary"> Donate 50 &euro; (just a test payment)
                    </button>
                    <p id="card-error" role="alert">
                        Error
                    </p>
                    <p class="result-message hidden">
                        Payment succeeded, see the result in your
                        <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe(
            'pk_test_51HftM2Hr1ZCotBHuiTWH6VTJ4SRZHQ3qQSKBnchjMxtCHF7ZNOuHtJboORDF6Ub321kdnORQdmQM7KsahZRjzjgO00XbalsySx'
        );
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        var cardElement = elements.getElement('card');
        cardElement.mount('#card-element');

        document.getElementById("button-submit").addEventListener("click", function() {

            stripe
                .confirmCardSetup('{{ $paymentIntent->client_secret }}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: 'John Doe',
                        },
                    },
                })
                .then(function(result) {
                    // Handle result.error or result.paymentIntent
                    if (result.error) {
                        console.log(result);
                    } else {
                        console.log(result);
                        document.getElementById("payment-method").value = result.setupIntent.payment_method;
                        document.getElementById("payment-form").submit();
                    }
                });
        })
    </script>
@endsection
