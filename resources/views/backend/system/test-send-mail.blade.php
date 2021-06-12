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
                                <h5 class="card-title">Test sending mail (SMTP Settings)</h5>
                                <div href="">
                                    <a href="{{ backendRouter('dashboard') }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Back</button>
                                    </a>
                                </div>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal" action="{{backendRouter('test-send-mail.post')}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="fname"
                                                               class="col-sm-3 text-right control-label col-form-label">Email *</label>
                                                        <div class="col-sm-8">
                                                            <input type="email" maxlength="65" class="form-control" required
                                                                   name="email" value="" placeholder="Enter email">
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