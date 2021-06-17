@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Transfer Confirm</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            Please enter the OTP code we sent to your email to make the transfer
                            <br> Note: the code is valid only within 3 minutes. <br> The transaction will expire at: {{ arrayGet($dataTransfer, 'end_time')  }}
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ frontendRouter('transfer-confirm.post') }}" method="POST">

                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                    @csrf

                                    <input type="hidden" name="user_id" class="form-control" value="{{ arrayGet($dataTransfer, 'user_id') }}">
                                    <input type="hidden" name="number" class="form-control" value="{{ arrayGet($dataTransfer, 'number') }}">
                                    <input type="hidden" name="message" class="form-control" value="{{ arrayGet($dataTransfer, 'message') }}">

                                    <div class="form-group">
                                        <label>OTP *</label>
                                        <input type="text" class="form-control" value="{{ old('random_str_otp') }}" name="random_str_otp" required maxlength="64">
                                    </div>

                                    <button class="btn btn-crown" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection