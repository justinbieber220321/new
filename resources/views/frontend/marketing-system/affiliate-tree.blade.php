@extends('layouts.frontend.main')

@push('style')
    <style>
        .affiliate-item .item {
            padding: 10px 15px;
            border: 1px solid #00acc1;
            display: inline-block;
            margin-right: 15px;
        }

        .affiliate-item .item span {
            display: block;
            width: 200px;
        }

        .affiliate-item-f1 {
            overflow: auto;
            width: 100%;
            display: flex;
        }

        .affiliate-item-f1 .itemF1 {
            margin: 8px;
            border: 1px solid #00acc1;
            padding: 10px 15px;
        }

        .affiliate-item-f1 .itemF1 span {
            display: block;
            width: 200px;
        }

        .list-dot small {
            color: #00acc1;
            display: block;
            font-size: 10px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .affiliate-item-f1 .itemF1 span {
                display: block;
            }
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Affiliate Tree</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box text-center">
                    <div class="affiliate-item">
                        <p class="item d-inline-block">
                            <span>
                                <a href="{{ frontendRouter('affiliate-tree') }}">
                                    {{ frontendCurrentUser()->username ? frontendCurrentUser()->username : frontendCurrentUser()->email  }}
                                </a>
                            </span>
                            <span>My bet: {{ getMyBet() }} USDT </span>
                            <span>Team bet: {{ getTeamBet() }} USDT</span>
                        </p>
                    </div>

                    @if ($isNotRoot)
                        <div class="list-dot">
                            <small>.</small>
                            <small>.</small>
                            <small>.</small>
                        </div>
                    @endif

                    @if ($f1)
                        <div class="affiliate-item mt-3">
                            <p class="item d-inline-block">
                                <span>
                                    <a href="">
                                        {{ $f1->username ? $f1->username : $f1->email }}
                                    </a>
                                </span>
                                <span>My bet: {{ getMyBet($f1) }} USDT </span>
                                <span>Team bet: {{ getTeamBet($f1) }} USDT</span>
                            </p>
                        </div>
                    @endif

                    @if ($fn)
                        <div class="affiliate-item affiliate-item-f1 mt-3  {{ $countFn >= 5 ? 'justify-content-between' : 'justify-content-center' }} ">
                            @foreach($fn as $item)
                                <p class="itemF1">
                                    <span><a href="{{ frontendRouter('affiliate-tree', ['userId' => $item->id]) }}">{{ $item->username ? $item->username : $item->email }}</a></span>
                                    <span>My bet: {{ getMyBet($item) }} USDT </span>
                                    <span>Team bet: {{ getTeamBet($item) }} USDT</span>
                                </p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection