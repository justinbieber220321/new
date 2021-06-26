@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Admin setting</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <small>
                            <form action="{{ frontendRouter('reward-system.post') }}" method="post">
                                @csrf
                                <button type="submit" href="" class="btn-danger btn btn-xs modal_confirm_delete rounded">
                                    Reward system
                                </button>
                            </form>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <small>Please delete cache to reload data
                            <a href="#modal_confirm_delete--cache" class="btn-danger btn btn-xs modal_confirm_delete rounded" data-toggle="modal">
                                Delete cache
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ frontendRouter('admin-setting.post') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TRX ADDRESS WITHDRAW</label>
                                        <input type="text" class="form-control" name="trx_address_withdraw"
                                               value="{{ old('trx_address_withdraw') ? old('trx_address_withdraw') : env('TRX_ADDRESS_WITHDRAW') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>TRX ADDRESS DEPOSIT</label>
                                        <input type="text" class="form-control" name="trx_address_deposit"
                                               value="{{ old('trx_address_deposit') ? old('trx_address_deposit') : env('TRX_ADDRESS_DEPOSIT') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>TRX PRIMARY KEY</label>
                                        <input type="text" class="form-control" name="trx_primary_key"
                                               value="{{ old('trx_primary_key') ? old('trx_primary_key') : env('TRX_PRIMARY_KEY') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Driver</label>
                                        <input type="text" class="form-control" required name="mail_driver" value="smtp" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label>Host</label>
                                        <input type="text" class="form-control" value="{{ old('mail_host') ? old('mail_host') : env('MAIL_HOST') }}"
                                               name="mail_host">
                                    </div>
                                    <div class="form-group">
                                        <label>Port</label>
                                        <input type="text" class="form-control" value="{{ old('mail_port') ? old('mail_port') : env('MAIL_PORT') }}"
                                               name="mail_port">
                                    </div>
                                    <div class="form-group">
                                        <label>Encryption</label>
                                        <input type="text" class="form-control" value="{{ old('mail_encryption') ? old('mail_encryption') : env('MAIL_ENCRYPTION') }}"
                                               name="mail_encryption">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="{{ old('mail_username') ? old('mail_username') : env('MAIL_USERNAME') }}"
                                               name="mail_username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" value="{{ old('mail_password') ? old('mail_password') : env('MAIL_PASSWORD') }}"
                                               name="mail_password">
                                    </div>
                                    <div class="form-group">
                                        <label>Mail from name</label>
                                        <input type="text" class="form-control" value="{{ old('mail_from_name') ? old('mail_from_name') : env('MAIL_FROM_NAME') }}"
                                               name="mail_from_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-crown">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade modal_confirm" id="modal_confirm_delete--cache" tabindex="-1" style="display: none;"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ frontendRouter('delete-cache') }}" method="POST" class="form_confirm_delete">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
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

@endsection