@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-4">
                <a href="{{ route('paypal.client_side') }}" class="btn btn-primary">Onetime payment - Client side
                    paypal</a>
            </div>
            <div class="col-md-6 text-center mt-4">
                <a href="{{ route('paypal.server_side') }}" class="btn btn-primary">Onetime payment - Server side
                    paypal</a>
            </div>
            <div class="col-md-6 text-center mt-4">
                <a href="{{ route('mollie.checkout') }}" class="btn btn-primary">Onetime payment - Mollie</a>
            </div>
            <div class="col-md-6 text-center mt-4">
                <a href="{{ route('stripe.checkout') }}" class="btn btn-primary">Onetime payment - Stripe</a>
            </div>
        </div>
    </div>
@endsection
