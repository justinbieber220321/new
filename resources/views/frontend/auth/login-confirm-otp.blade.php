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
                        <p class="text-h3 mb-2 mt-1">Please check your email then fill otp code to login</p>
                    </div>

                    <form action="{{ frontendRouter('login.confirm-opt.post') }}" method="POST" class="mt-3">

                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $userId }}">

                        <div class="form-group mb-3">
                            <input type="text" name="code_otp" class="form-control" required
                                   value="{{ old('code_otp') ? old('code_otp') : '' }}"
                                   placeholder="{{ transMessage('placeholder_', ['field' => 'OTP']) }}">
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block btn-submit" type="submit">Log In</button>
                        </div>
                    </form>
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