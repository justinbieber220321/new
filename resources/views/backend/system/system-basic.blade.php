@extends('layouts.backend.main')

@push('script')
    <script src="{{ asset('backend/js/pages/system.js') }}"></script>

    <script>
        var validate = function(e) {
            var t = e.value;
            e.value = (t.indexOf(",") >= 0) ? (t.substr(0, t.indexOf(",")) + t.substr(t.indexOf(","), 3)) : t;
        }
    </script>
@endpush

@section('content')
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
                                <h5 class="card-title">Setting basic system information</h5>
                                <div href="">
                                    <a href="{{ backendRouter('dashboard') }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Back</button>
                                    </a>
                                </div>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal" action="{{backendRouter('setting-system.post')}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Site name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="site_name" value="{{ old('name') ? old('name') : getSiteName() }}" placeholder="Enter site name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Title</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="title" value="{{ old('title') ? old('title') : getSiteTitle() }}"
                                                                   placeholder="Enter title web">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email"
                                                               class="col-sm-3 text-right control-label col-form-label">Meta title</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="65" class="form-control"
                                                                   name="meta_title" value="{{ old('meta_title') ? old('meta_title') : getSiteMetaTitle() }}"
                                                                   placeholder="Enter meta title">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Meta description</label>
                                                        <div class="col-sm-8">
                                                            <textarea rows="4" maxlength="255" name="meta_description"
                                                                      placeholder="Enter meta description" class="form-control"
                                                            >{{ old('meta_description') ? old('meta_description') : getSiteMetaDescription() }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control phone-inputmask"
                                                                   name="phone" id="phone-mask" value="{{ old('phone') ? old('phone') : getSitePhone() }}"
                                                                   placeholder="Enter phone">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Rate rps</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" oninput="validate(this)"
                                                                   name="rate_rps" value="{{ old('rate_rps') ? old('rate_rps') : getEnvX('RATE_RPS') }}" placeholder="Enter rate rps">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-3 text-right control-label col-form-label">Required otp login</label>
                                                        <div class="col-md-8">
                                                            <div class="item_radio_select item_select_gender">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="otp-on" name="required-otp-login" class="custom-control-input" value="{{ getConfig('otp-login.on') }}"
                                                                    {{  getEnvX('LOGIN_CONFIRM_OTP') == getConfig('otp-login.on') ? "checked" : ""}}>
                                                                    <label class="custom-control-label" for="otp-on">Yes</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="otp-off" name="required-otp-login" class="custom-control-input" value="{{ getConfig('otp-login.off') }}"
                                                                            {{  getEnvX('LOGIN_CONFIRM_OTP') == getConfig('otp-login.off') ? "checked" : ""}}>
                                                                    <label class="custom-control-label" for="otp-off">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Logo</label>
                                                        <div class="col-sm-8">
                                                            <div class="form-input-wrapper uploadLogo">
                                                                <div class="img-thumbnail-wrapper">
                                                                    <input type="file" id="uploadLogo" name="logo" style="display: none">
                                                                    @if (getEnvX('SITE_LOGO'))
                                                                        <img src="{{ asset(getEnvX('SITE_LOGO')) }}" class="img-thumbnail">
                                                                    @else
                                                                        <img src="{{ asset('frontend/image/profile_img.png') }}" class="img-thumbnail">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Favicon</label>
                                                        <div class="col-sm-8">
                                                            <div class="form-input-wrapper uploadFavicon">
                                                                <div class="img-thumbnail-wrapper">
                                                                    <input type="file" id="uploadFavicon" name="favicon" style="display: none">
                                                                    @if (getEnvX('SITE_FAVICON'))
                                                                        <img src="{{ asset(getEnvX('SITE_FAVICON')) }}" class="img-thumbnail">
                                                                    @else
                                                                        <img src="{{ asset('frontend/image/profile_img.png') }}" class="img-thumbnail">
                                                                    @endif
                                                                </div>
                                                            </div>
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