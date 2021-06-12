@extends('layouts.backend.main')

@section('content')
<div class="content-page">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Module User</h4>
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
                            <a href="{{ backendRouter('user.edit', ['id' => $entity->id]) }}">
                                <button type="button" class="btn btn-cyan btn-sm">Back</button>
                            </a>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="card">
                                <form class="form-horizontal" action="{{backendRouter('user.change-password.post', ['id' => $entity->getKey()])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">New Password <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password" value="" placeholder="Please enter new password" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 text-right control-label col-form-label">New Password Confirm <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password_confirmation" value="" placeholder="Please re-enter new password" required>
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
                                                        <label for="email" class="col-sm-3 text-right control-label col-form-label"></label>
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