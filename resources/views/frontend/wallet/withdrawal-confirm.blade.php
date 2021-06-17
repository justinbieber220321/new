@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Withdrawal Confirm</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            Please enter the OTP code we sent to your email to make the withdrawal
                            <br> Note: the code is valid only within {{ getConfig('time_limit_otp_code') }} minutes. <br> The transaction will expire at: {{ arrayGet($dataWithdrawConfirm, 'end_time')  }}
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ frontendRouter('withdrawal-confirm.post') }}" method="POST">

                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                    @csrf

                                    <input type="hidden" name="address" class="form-control" value="{{ arrayGet($dataWithdrawConfirm, 'address') }}">
                                    <input type="hidden" name="number" class="form-control" value="{{ arrayGet($dataWithdrawConfirm, 'number') }}">

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