@extends('layouts.frontend.main')

@push('style')

@endpush

@section('content')
    <script>
        function copyToClipboard(element) {
            console.log('xxx');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Please transfer</label>
                                    <div class="d-flex">
                                        <input type="text" disabled class="form-control" id="address-deposit" value="{{ env('TRX_ADDRESS_DEPOSIT') }}">
                                        <button class="btn btn-crown btn-xs" onclick="copyToClipboard('#address-deposit')">Copy!</button> <!-- @todo copy -->
                                    </div>
                                    <small>with tag (note): {{ frontendCurrentUser()->user_id }}</small>
                                    <br>
                                    <small class="text-danger">Please enter correct user_id. Otherwise the system will not record.</small>
                                </div>
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
                        <h1 class="header-title">Check Deposit</h1>

                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')

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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection