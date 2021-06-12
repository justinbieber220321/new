@extends('layouts.backend.auth')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div id="loginform">
                <div class="text-center pt-3 pb-3">
                    <h3 style="color: white"> PASSWORD RECOVER </h3>
                </div>

                <!-- Form -->
                <form class="form-horizontal mt-3" action="{{ backendRouter('recovery-password.post') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{$admin->id}}">

                    @include('layouts.backend.structures._notification')
                    @include('layouts.backend.structures._error_validate')

                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white h-100"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Please enter new password" required="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white h-100"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Please re-enter new password" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pt-3">
                                    @include('layouts.backend.structures.elements._btn_submit_auth')
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

