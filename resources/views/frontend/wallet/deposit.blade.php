@extends('layouts.frontend.main')

@push('style')

@endpush

@section('content')
    <script>
        function copyToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("address-deposit");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");
        }
    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Deposit</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="header-title">Deposit Now</h1>
                        <div class="row mt-3">
                            <div class="col-md-6" style="padding-top: 20px">
                                <div class="form-group">
                                    <label>Please transfer USDT TRC 20</label>
                                    <div class="d-flex">
                                        <input type="text" readonly class="form-control" id="address-deposit" value="{{ frontendCurrentUser()->address }}">
                                        <button class="btn btn-crown btn-xs" onclick="copyToClipboard()">Copy!</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! QrCode::size(150)->generate(frontendCurrentUser()->address); !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="header-title">Request to check new deposit transaction</h1>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>You have transferred the account but the system has not recorded it yet?</label>
                                    <form action="{{ frontendRouter('check-deposit.post') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-crown btn-xs">Check Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')
                    </div>
                    <div class="card-body">
                        <h1 class="header-title">View deposit history</h1>
                        <a href="{{  frontendRouter('wallet-history') }}">here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
