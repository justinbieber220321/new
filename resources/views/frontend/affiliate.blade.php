@extends('layouts.frontend.frontend-new')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend-new/css/affiliate.css') }}">
@endpush

@section('content')
    <main>
        <section class="section-affiliate">
            <div class="affiliate-inner">
                <div class="affiliate-content">
                    <h2 class="affiliate-title">AFFILIATE</h2>
                    <div class="discount-wrapper">
                        <ul class="list-discount">
                            <li class="discount-item">
                                <div class="discount-image"><img src="{{ asset('frontend-new/img/affiliate/affiliate_img_01.png') }}" alt="DISCOUNT">
                                    <div class="discount-content">
                                        <h3 class="discount-label">DISCOUNT</h3>
                                        <p class="discount-value">0.1%</p>
                                    </div>
                                </div>
                                <div class="discount-detail">
                                    <p class="discount-text">Personal Volume 1000$</p>
                                    <p class="discount-text">Total volume team 50,000$</p>
                                </div>
                            </li>
                            <li class="discount-item">
                                <div class="discount-image"><img src="{{ asset('frontend-new/img/affiliate/affiliate_img_02.png') }}" alt="DISCOUNT">
                                    <div class="discount-content">
                                        <h3 class="discount-label">DISCOUNT</h3>
                                        <p class="discount-value">0.2%</p>
                                    </div>
                                </div>
                                <div class="discount-detail">
                                    <p class="discount-text">Personal Volume 2000$</p>
                                    <p class="discount-text">Total volume team 150,000$</p>
                                </div>
                            </li>
                            <li class="discount-item">
                                <div class="discount-image"><img src="{{ asset('frontend-new/img/affiliate/affiliate_img_03.png') }}" alt="DISCOUNT">
                                    <div class="discount-content">
                                        <h3 class="discount-label">DISCOUNT</h3>
                                        <p class="discount-value">0.3%</p>
                                    </div>
                                </div>
                                <div class="discount-detail">
                                    <p class="discount-text">Personal Volume 3000$ </p>
                                    <p class="discount-text">Total volume team 350,000$</p>
                                    <p class="discount-text">Minimum 6F1, each F1 has personal bet &gt;= 500$</p>
                                </div>
                            </li>
                            <li class="discount-item">
                                <div class="discount-image"><img src="{{ asset('frontend-new/img/affiliate/affiliate_img_04.png') }}" alt="DISCOUNT">
                                    <div class="discount-content">
                                        <h3 class="discount-label">DISCOUNT</h3>
                                        <p class="discount-value">0.4%</p>
                                    </div>
                                </div>
                                <div class="discount-detail">
                                    <p class="discount-text">Personal Volume 5.000$</p>
                                    <p class="discount-text">Total volume team 1.200,000$</p>
                                    <p class="discount-text">Minimum 9F1, each F1 has personal bet &gt;= 500$</p>
                                    <p class="discount-text">There are 3 branches Level 2</p>
                                </div>
                            </li>
                            <li class="discount-item">
                                <div class="discount-image"><img src="{{ asset('frontend-new/img/affiliate/affiliate_img_05.png') }}" alt="DISCOUNT">
                                    <div class="discount-content">
                                        <h3 class="discount-label">DISCOUNT</h3>
                                        <p class="discount-value">0.5%</p>
                                    </div>
                                </div>
                                <div class="discount-detail">
                                    <p class="discount-text">Personal Volume 10,000$</p>
                                    <p class="discount-text">Total volume team 3,000,000$</p>
                                    <p class="discount-text">Minimum 15F1, each F1 has personal bet &gt;= 500$</p>
                                    <p class="discount-text">There are 6 branches to Level 2</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="affiliate-note"> <span>Note: </span>The same level from level 4 – level 5 is entitled to 15% of the income of the sub-branches with level greater than</div>
            </div>
        </section>
    </main>
@endsection