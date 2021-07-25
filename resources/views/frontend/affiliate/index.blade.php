@extends('layouts.frontend.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/affiliate.css') }}">
@endpush

@push('script')
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Affiliate</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12  ">
                <a href="{{ frontendRouter('affiliate') }}" class="btn btn-soft-secondary btn-xs">My Affiliate</a>
            </div>
        </div>
        <br>

        <div class="row mt-2">
            <div class="col-4">
                <div class="card-box">
                    My volume: {{ formatPriceCurrency($myBet) }} USDT
                </div>
            </div>

            <div class="col-4">
                <div class="card-box">
                    Team volume: {{ formatPriceCurrency($myBetTeam) }} USDT
                </div>
            </div>

            <div class="col-4">
                <div class="card-box">
                    Balance: {{ formatPriceCurrency(getBalance($userAffiliate->id)) }} {{ getConfig('currency_default') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-2">
                <div class="card-box">
                    <h4 class="fs-20 text-black">
                        <a style="color: black" href="javascript:void(0)" id="link-affiliate">
                            {{ $linkAff }} &nbsp
                            <i class="fe-maximize icon-copy" title="Copy" onclick="copyToClipboard('#link-affiliate')"></i>
                        </a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="team">
                            <div class="tab">
                                <button class="tablinks active" onclick="openCity(event, 'level1')">Floor 1</button>
                                <button class="tablinks" onclick="openCity(event, 'level2')">Floor 2</button>
                                <button class="tablinks" onclick="openCity(event, 'level3')">Floor 3</button>
                                <button class="tablinks" onclick="openCity(event, 'level4')">Floor 4</button>
                                <button class="tablinks" onclick="openCity(event, 'level5')">Floor 5</button>
                            </div>

                            <br>

                            <div id="level1" class="tabcontent" style="display: block;">
                                <div class="intro-y tab-content">
                                    <div class="intro-y overflow-auto mt-8 sm:mt-0">
                                        <table class="table table-striped table-responsive-sm">
                                            @include('frontend.affiliate._table_thead_affiliate')
                                            <tbody>
                                            @if (!empty($userAffiliate))
                                                @foreach($userAffiliate->childrenRecursive as $userLevel1)
                                                    @include('frontend.affiliate._table_tbody_affiliate', ['aff' => $userLevel1])
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="level2" class="tabcontent" style="display: none;">
                                <table class="table table-striped table-responsive-sm">
                                    @include('frontend.affiliate._table_thead_affiliate')
                                    <tbody>
                                    @foreach($userAffiliate->childrenRecursive as $userLevel1)
                                        @foreach($userLevel1->childrenRecursive as $l2)
                                            @include('frontend.affiliate._table_tbody_affiliate', ['aff' => $l2])
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="level3" class="tabcontent" style="display: none;">
                                <table class="table table-striped table-responsive-sm">
                                    @include('frontend.affiliate._table_thead_affiliate')
                                    <tbody>
                                    @foreach($userAffiliate->childrenRecursive as $userLevel1)
                                        @foreach($userLevel1->childrenRecursive as $userLevel2)
                                            @foreach($userLevel2->childrenRecursive as $l3)
                                                @include('frontend.affiliate._table_tbody_affiliate', ['aff' => $l3])
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="level4" class="tabcontent" style="display: none;">
                                <table class="table table-striped table-responsive-sm">
                                    @include('frontend.affiliate._table_thead_affiliate')
                                    <tbody>
                                    @foreach($userAffiliate->childrenRecursive as $userLevel1)
                                        @foreach($userLevel1->childrenRecursive as $userLevel2)
                                            @foreach($userLevel2->childrenRecursive as $l3)
                                                @foreach($l3->childrenRecursive as $l4)
                                                    @include('frontend.affiliate._table_tbody_affiliate', ['aff' => $l4])
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="level5" class="tabcontent" style="display: none;">
                                <table class="table table-striped table-responsive-sm">
                                    @include('frontend.affiliate._table_thead_affiliate')
                                    <tbody>
                                    @foreach($userAffiliate->childrenRecursive as $l1)
                                        @foreach($l1->childrenRecursive as $l2)
                                            @foreach($l2->childrenRecursive as $l3)
                                                @foreach($l3->childrenRecursive as $l4)
                                                    @foreach($l4->childrenRecursive as $l5)
                                                        @include('frontend.affiliate._table_tbody_affiliate', ['aff' => $l5])
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
