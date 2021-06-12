@extends('layouts.backend.auth')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div id="loginform">
                <div class="text-center pt-3 pb-3">
                    <h1><strong class="db" style="color: white">FORGOT PASSWORD</strong></h1>
                </div>

                <!-- Form -->
                <form class="form-horizontal mt-3" action="{{ backendRouter('forgot-password.post') }}" method="POST">
                    @csrf

                    @include('layouts.backend.structures._notification')
                    @include('layouts.backend.structures._error_validate')

                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white h-100"><i
                                                class="ti-user"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control form-control-lg"
                                       placeholder="Please enter your email" required="" value="{{ old('email') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pt-3">
                                    @include('layouts.backend.structures.elements._btn_submit_auth')
                                    <a href="{{ backendRouter('login') }}" class="btn btn-info float-end text-white"
                                       type="submit">
                                        <i class="fa fa-undo"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

