@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{ route('mollie.payment') }}"> Donate 50 &euro; (just a test mollie payment)</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
