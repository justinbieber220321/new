@extends('layouts.backend.main')

@push('script')
    <script src="/backend/js/pages/system.js"></script>
@endpush

@section('content')
    <style>
        .img-thumbnail {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
    <div class="content-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Setting system</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('layouts.backend.structures._notification')
                            @include('layouts.backend.structures._error_validate')

                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Setting sending mail (SMTP Settings)</h5>
                                <div href="">
                                    <a href="{{ backendRouter('dashboard') }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Back</button>
                                    </a>
                                </div>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal" action="{{backendRouter('setting-send-mail.post')}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Driver</label>
                                                        <div class="col-sm-8">
                                                            <div class="my-select2">
                                                                <select class="my-select2__select2 select2-wrapper" name="mail_driver">
                                                                    <option selected value="smtp">smtp</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Host</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="mail_host" value="{{ old('mail_host') ? old('mail_host') : getEnvX('MAIL_HOST') }}" placeholder="Nhập mail host">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Port</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="mail_port" value="{{ old('mail_port') ? old('mail_port') : getEnvX('MAIL_PORT') }}" placeholder="Nhập mail port">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Encryption</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="mail_encryption" value="{{ old('mail_encryption') ? old('mail_encryption') : getEnvX('MAIL_ENCRYPTION') }}" placeholder="Nhập mail encryption">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Username</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="mail_username" value="{{ old('mail_username') ? old('mail_username') : getEnvX('MAIL_USERNAME') }}" placeholder="Nhập mail username">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Password</label>
                                                        <div class="col-sm-8">
                                                            <input type="password" maxlength="65" class="form-control"
                                                                   name="mail_password" value="{{ old('mail_password') ? old('mail_password') : getEnvX('MAIL_PASSWORD') }}" placeholder="Nhập mail password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Mail from name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="mail_from_name" value="{{ old('mail_from_name') ? old('mail_from_name') : getEnvX('MAIL_FROM_NAME') }}" placeholder="Nhập mail from name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                                            <div class="col-sm-8">
                                                                @include('layouts.backend.structures.elements._btn_submit_auth')
                                                                <a href="{{ backendRouter('test-send-mail') }}" class="btn btn-success">Test send mail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
@stop