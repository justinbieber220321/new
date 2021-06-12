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
                                <h5 class="card-title">Update user info</h5>
                                <div href="">
                                    <a href="{{ backendRouter('user.change-password', ['id' => $entity->getKey()]) }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Update password</button>
                                    </a>
                                    <a href="{{ backendRouter('user.list') }}">
                                        <button type="button" class="btn btn-cyan btn-sm">Back</button>
                                    </a>
                                </div>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="card">
                                    <form class="form-horizontal"
                                          action="{{backendRouter('user.update', ['id' => $entity->getKey()])}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $entity->id }}">

                                        @include('backend.user._form')
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