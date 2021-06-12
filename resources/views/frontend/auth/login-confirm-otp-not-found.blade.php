@extends('layouts.frontend.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
                <div class="card-body p-4">

                    <div class="text-center w-75 m-auto">
                        <h3>{{ strtoupper(getSiteName()) }}</h3>
                        <p class="text-muted mb-4 mt-3">OTP code verification</p>
                        <h5>The link you used is not valid. <br> Please try again.</h5>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-white-50">Back to <a href="{{ frontendRouter('login.get') }}" class="text-white ml-1"><b>Login</b></a></p>
                </div>
            </div>
        </div>
    </div>
@endsection



