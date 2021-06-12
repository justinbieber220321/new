@extends('layouts.backend.main')

@push('styles')
    <link href="/backend/css/dashboard.css" rel="stylesheet">
@endpush

@section('content')
    <div class="content-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Page dashboard</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @include('layouts.backend.structures._notification')

                            <div class="card-body__head card-body__filter text-center">
                                <a href="{{ backendRouter('setting-system') }}"
                                   class="btn-cyan btn btn-xs modal_confirm_delete rounded"
                                >
                                    System configuration
                                </a>

                                <a href="{{ backendRouter('setting-send-mail') }}"
                                   class="btn-cyan btn btn-xs modal_confirm_delete rounded"
                                >
                                    Configure mail
                                </a>

                                <a href="{{ backendRouter('admin.change-password') }}"
                                   class="btn-cyan btn btn-xs modal_confirm_delete rounded"
                                >
                                    Update password
                                </a>

                                <a href="{{ backendRouter('logout') }}"
                                   class="btn-cyan btn btn-xs modal_confirm_delete rounded"
                                >
                                    Logout
                                </a>

                                <a href="#modal_confirm_delete--cache"
                                   class="btn-danger btn btn-xs modal_confirm_delete rounded"
                                   data-toggle="modal"
                                >
                                    Delete cache
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

        </div>
    </div>

    <div class="modal fade modal_confirm" id="modal_confirm_delete--cache" tabindex="-1" style="display: none;"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ backendRouter('delete-cache') }}" method="POST" class="form_confirm_delete">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Delete cache, are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-sm btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
