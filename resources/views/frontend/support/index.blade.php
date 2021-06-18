@extends('layouts.frontend.main')

@push('style')
    <style>
        .support {
            padding-top: 64px;
        }

        .support__wrapper__content {
            background: #0B0A3A;
            padding: 3rem;
            border-radius: 10px;
        }

        .support__wrapper__content__header p {
            font-weight: 700;
            color: white;
        }

        .support__wrapper__content__main {
            padding-left: 48px;
            color: #74738E;
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
                    <h4 class="page-title">Support</h4>
                </div>
            </div>
        </div>

        <div class="support">
            <div class="row">
                <div class="col-md-3 col-lg-4"></div>
                <div class="col-md-6 col-lg-4">
                    <div class="support__wrapper__content">
                        <div class="support__wrapper__content__header">
                            <p>We will support you</p>
                        </div>
                        <div class="support__wrapper__content__main">
                            <p>Email: support@whalerich.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection