@extends('layouts.frontend.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
                <div class="card-body">

                    <div class="text-center w-75 m-auto">
                        <h3>
                            <img src="{{ asset('frontend/assets/images/logo1.png') }}" alt="">
                        </h3>
                        <p class="text-h1 mb-2 mt-1" style="font-size: 20px;">otp authentication</p>
                    </div>

                    <form action="{{ frontendRouter('login.post') }}" method="POST">

                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')
                        @csrf

                        <div class="form-group mb-3">
                            <input class="form-control" type="email" name="email" required="" placeholder="Enter your email" value="{{old('email')}}">
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block btn-submit" type="submit">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
