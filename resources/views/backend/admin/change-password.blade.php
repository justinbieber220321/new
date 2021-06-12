@extends('layouts.backend.main')

@section('content')
    <div class="content-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Admin</h4>
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
                                <h5 class="card-title">Update password</h5>
                                <div href="">
                                    <a href="{{ backendRouter('dashboard') }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Back</button>
                                    </a>
                                </div>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal" action="{{backendRouter('admin.change-password.post')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                                            Old password
                                                            <span class="text-danger">(*)</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="password" required class="form-control" name="old_password" value="" placeholder="Enter old password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                                            New password
                                                            <span class="text-danger">(*)</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="password" required class="form-control" name="new_password" value="" placeholder="Enter new password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                                            New password confirmation
                                                            <span class="text-danger">(*)</span>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="password" required class="form-control" name="new_password_confirmation" value="" placeholder="Re-enter new password">
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
                                                            <label for="fname"
                                                                   class="col-sm-3 text-right control-label col-form-label"></label>
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