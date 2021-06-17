@extends('layouts.frontend.main')

@push('style')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ frontendRouter('wallet-history') }}" class="btn btn-crown btn-xs">Back</a>
                    </div>
                    <h4 class="page-title">History Deposit</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-box mb-0">
                        <h4 class="header-title mb-3">History Deposit</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>From Users</th>
                                    <th>Message</th>
                                    <th>Number (USDT)</th>
                                    <th>Time Insert</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($listDeposit as $key => $deposit)
                                        <tr>
                                            <th scope="row">{{ 1 + $key }}</th>
                                            <td>{{ $deposit->tryGet('userDepositFrom')->email }}</td>
                                            <td>{{ $deposit->message }}</td>
                                            <td>{{ formatPriceCurrency($deposit->number) }}</td>
                                            <td>{{ $deposit->ins_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $listDeposit->appends(\Illuminate\Support\Facades\Input::all())->links('layouts.frontend.structures._pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection