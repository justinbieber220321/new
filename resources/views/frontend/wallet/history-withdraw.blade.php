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
                    <h4 class="page-title">History Withdraw</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-box mb-0">
                        <h4 class="header-title mb-3">History Withdraw</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>To Users</th>
                                    <th>Message</th>
                                    <th>Number (USDT)</th>
                                    <th>Type</th>
                                    <th>Time Insert</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listWithdraw as $key => $withdraw)
                                    <tr>
                                        <th scope="row">{{ 1 + $key }}</th>
                                        <td>{{ $withdraw->tryGet('userWithdrawToUser')->email }}</td>
                                        <td>{{ $withdraw->message }}</td>
                                        <td>{{ formatPriceCurrency($withdraw->number) }}</td>
                                        <td>
                                            @if ($withdraw->type == getConfig('withdraw-type.transfer'))
                                                <div class="badge label-table badge-success"> Transfer</div>
                                            @elseif($withdraw->type == getConfig('withdraw-type.fee'))
                                                <div class="badge label-table badge-warning"> Fee</div>
                                            @elseif($withdraw->type == getConfig('withdraw-type.withdraw'))
                                                <div class="badge label-table badge-danger"> Withdraw</div>
                                            @endif
                                        </td>
                                        <td>{{ $withdraw->ins_date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $listWithdraw->appends(\Illuminate\Support\Facades\Input::all())->links('layouts.frontend.structures._pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection