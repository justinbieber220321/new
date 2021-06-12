@extends('layouts.frontend.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
                <div class="card-body p-4">

                    <div class="text-center w-75 m-auto">
                        <h3>CASINO</h3>
                        <p class="text-muted mb-4 mt-3">Please check your email <br>then fill otp code to login</p>
                    </div>

                    <form action="{{ frontendRouter('login.confirm-opt.post') }}" method="POST">

                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $userId }}">

                        <div class="form-group mb-3">
                            <label for="emailaddress">OTP *</label>
                            <input type="text" name="code_otp" class="form-control" required
                                   value="{{ old('code_otp') ? old('code_otp') : '' }}"
                                   placeholder="{{ transMessage('placeholder_', ['field' => 'OTP']) }}">
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">Log In</button>
                        </div>
                    </form>
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