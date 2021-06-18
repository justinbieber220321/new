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
                        <form action="{{ frontendRouter('admin-setting.post') }}" method="POST">
                            @csrf
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
                                        <input type="text" class="form-control" required name="mail_driver" value="smtp">
                                    </div>
                                    <div class="form-group">
                                        <label>Host</label>
                                        <input type="text" class="form-control" value="{{ old('mail_host') ? old('mail_host') : env('MAIL_HOST') }}"
                                               name="host">
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
                                        <input type="text" class="form-control" value="{{ old('mail_password') ? old('mail_password') : env('MAIL_PASSWORD') }}"
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

@endsection