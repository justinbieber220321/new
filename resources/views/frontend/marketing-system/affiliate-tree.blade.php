@extends('layouts.frontend.main')

@push('style')
    <style>
        .affiliate-item .item {
            padding: 10px 15px;
            border: 1px solid #B600F1;
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
            border: 1px solid #B600F1;
            padding: 10px 15px;
        }

        .affiliate-item-f1 .itemF1 span {
            display: block;
            width: 200px;
        }

        .list-dot small {
            color: #B600F1;
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
                            @php $bet = getBet(frontendCurrentUser()); @endphp
                            <span>Level: {{ arrayGet($bet, 'level') }}</span>
                            <span>Reward: {{ arrayGet($bet, 'reward') }}</span>
                            <span>Matching: {{ arrayGet($bet, 'matching') }}</span>
                            <span>My volume: {{ arrayGet($bet, 'turnover') }} USDT </span>
                            <span>Team volume: {{ arrayGet($bet, 'team_turnover') }} USDT</span>


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
                                    <a href="{{ frontendRouter('affiliate-tree', ['userId' => $f1->user_id])}}">
                                        {{ $f1->username ? $f1->username : $f1->email }}
                                    </a>
                                </span>

                                @php $betF1 = getBet($f1); @endphp


                                <span>Level: {{ arrayGet($betF1, 'level') }}</span>
                                <span>Estimate reward: {{ arrayGet($betF1, 'reward') }}</span>
                                <span>Estimate matching: {{ arrayGet($betF1, 'matching') }}</span>
                                <span>My volume: {{ arrayGet($betF1, 'turnover') }} USDT </span>
                                <span>Team volume: {{ arrayGet($betF1, 'team_turnover') }} USDT</span>

                            </p>
                        </div>
                    @endif

                    @if ($fn)
                        <div class="affiliate-item affiliate-item-f1 mt-3  {{ $countFn >= 5 ? 'justify-content-between' : 'justify-content-center' }} ">
                            @foreach($fn as $item)
                                <p class="itemF1">
                                    <span>
                                        @if (count($item->children) > 0)
                                            <a href="{{ frontendRouter('affiliate-tree', ['userId' => $item->user_id])  }}" class="text-danger">
                                                {{ $item->username ? $item->username : $item->email }}</a>
                                        @else
                                            <a href="javascript:void(0)">
                                                {{ $item->username ? $item->username : $item->email }}</a>
                                        @endif
                                    </span>

                                    @php $infoBet = getBet($item) @endphp


                                    <span>Level: {{ arrayGet($infoBet, 'level') }}</span>
                                    <span>Estimate reward : {{ arrayGet($infoBet, 'reward') }}</span>
                                    <span>Estimate matching: {{ arrayGet($infoBet, 'matching') }}</span>
                                    <span>My volume: {{ arrayGet($infoBet, 'turnover') }} USDT</span>
                                    <span>Team volume: {{ arrayGet($infoBet, 'team_turnover') }} USDT</span>


                                </p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
