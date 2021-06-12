@extends('layouts.frontend.main')

@push('style')
    <link href="{{ asset('frontend/css/user.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('frontend/js/user.js') }}"></script>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">{{ transF('layout.sidebar.update-password') }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" style="height: auto">
                            <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">

                                <div class="basic-form">

                                    <form method="post" action="{{ frontendRouter('account.update-password.post') }}">

                                        @csrf
                                        @include('layouts.frontend.structures._notification')
                                        @include('layouts.frontend.structures._error_validate')

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{ transF('form.old-password') }} <span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="password" required name="old_password" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{ transF('form.new-password') }} <span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="password" required name="new_password" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{ transF('form.new-password-confirmation') }} <span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="password" required name="new_password_confirmation" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-5">
                                                <a href="{{ frontendRouter('account') }}" class="btn btn-soft-secondary btn-xs"><i class="fa fa-arrow-left"></i> {{ transF('btn.back') }}</a>
                                                @include('theme.structures._btn_submit')
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection