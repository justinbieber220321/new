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
            width: 150px;
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
            width: 150px;
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
                            <span>{{ frontendCurrentUser()->username ? frontendCurrentUser()->username : frontendCurrentUser()->email  }}</span>
                            <span>My bet: 10 Usdt </span>
                            <span>Team bet: 100 Usdt</span>
                        </p>
                    </div>

                    <div class="list-dot">
                        <small>.</small>
                        <small>.</small>
                        <small>.</small>
                    </div>

                    @php $c = 3; @endphp
                    <div class="affiliate-item affiliate-item-f1 mt-3  {{ $c >=5 ? 'justify-content-between' : 'justify-content-center' }} ">
                        {{--@foreach($f1 as $item)--}}
                        @for($i=0; $i<$c; $i++)
                            <p class="itemF1">
                                <span>sadsdaffds</span>
                                <span>My bet: 10 Usdt </span>
                                <span>Team bet: 100 Usdt</span>
                            </p>
                        @endfor
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection