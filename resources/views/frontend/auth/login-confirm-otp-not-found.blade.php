@extends('layouts.frontend.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
                <div class="card-body">

                    <div class="text-center m-auto">
                        <h3>
                            <img src="{{ asset('frontend/assets/images/logo1.png') }}" alt="">
                        </h3>
                        <p class="text-h3 mb-2 mt-1">OTP code verification</p>
                        <h5 style="color: #B600F1">The link you used is not valid. Please try again.</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50">Back to <a href="{{ frontendRouter('login.get') }}" class="ml-1"><b>Login</b></a></p>
                </div>
            </div>
        </div>
    </div>
@endsection



