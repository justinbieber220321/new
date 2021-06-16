@extends('layouts.frontend.main')

@push('script')
    <script src="{{ asset('/frontend/js/wallet.js') }}"></script>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Withdrawal</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="header-title">Request Withdrawal</h1>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <form action="{{ frontendRouter('request-withdrawal.post') }}" method="POST">

                                @include('layouts.frontend.structures._notification')
                                @include('layouts.frontend.structures._error_validate')
                                @csrf

                                <div class="form-group">
                                    <label>TRC 20 Address *</label>
                                    {{--<input type="text" maxlength="34" minlength="34" class="form-control" name="address" value="{{ old('address') }}" required>--}}
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Amount *</label>
                                    {{--<input type="number" class="form-control" value="{{ old('number') }}" name="amount" required min="0" max="{{ $maxAmount }}">--}}
                                    <input type="number" autocomplete="off" class="form-control" value="{{ old('number') }}" name="number" required min="0">
                                </div>

                                <p>Fee: <span id="fee">0 </span> USDT</p>

                                <button class="btn btn-crown" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection