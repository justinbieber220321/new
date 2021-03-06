<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>{{ getEnvX('SITE_TITLE', 'Crown') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo1.png') }}">
    <link href="{{ asset('frontend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('frontend/assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="{{ asset('frontend/assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css"
          id="app-default-stylesheet"/>
    <link href="{{ asset('frontend/assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet" disabled/>
    <link href="{{ asset('frontend/assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
          id="app-dark-stylesheet" disabled/>
    <link href="{{ asset('frontend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('frontend/vendor/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/common.css') }}">

    @stack('style')
</head>

<body stype="padding-bottom: 0px !important" data-layout='{"mode": "dark", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('theme/image/profile/default-user.png') }}" alt="" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                                    {{ frontendCurrentUser()->username }} <i class="mdi mdi-chevron-down"></i>
                                </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ frontendRouter('account') }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="{{ frontendRouter('logout') }}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ frontendRouter('home') }}" class="logo logo-light text-center">
                    <span class="logo-sm"><img src="{{ asset('frontend/assets/images/logo1.png') }}"
                                               width="50px"></span>
                    <span class="logo-lg"><img src="{{ asset('frontend/assets/images/logo1.png') }}"
                                               width="100px"></span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu left-side-menu1">
        <div class="h-100" data-simplebar>
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li>
                        <a href="https://whalerich.com/">
                            <i data-feather="gift"></i>
                            <span>Home</span>
                        </a>

                    </li>

                    <li>
                        <a href="https://www.game-insure.com/">
                            <i data-feather="gift"></i>
                            <span>Policy</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ frontendRouter('home') }}">
                            <i data-feather="gift"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#sidebarWallet" data-toggle="collapse">
                            <i data-feather="gift"></i>
                            <span> Wallet </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarWallet">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ frontendRouter('deposit') }}">Deposit</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('transfer') }}">Transfer Coin</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('wallet-history') }}">Wallet History</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('withdrawal') }}">Request Withdrawal</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarMarketingSystem" data-toggle="collapse">
                            <i data-feather="gift"></i>
                            <span>Marketing system</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarMarketingSystem">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ frontendRouter('referrals') }}">Marketing System</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('affiliate-tree') }}">Affiliate Tree</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--<li>--}}
                    {{--<a href="#sidebarCasinoHistory" data-toggle="collapse">--}}
                    {{--<i data-feather="gift"></i>--}}
                    {{--<span>Casino history</span>--}}
                    {{--<span class="menu-arrow"></span>--}}
                    {{--</a>--}}
                    {{--<div class="collapse" id="sidebarCasinoHistory">--}}
                    {{--<ul class="nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="{{ frontendRouter('casino-report') }}">Casino Report</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ frontendRouter('bet-history') }}">Bet History</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</li>--}}

                    <li>
                        <a href="{{ frontendRouter('account') }}">
                            <i data-feather="gift"></i>
                            <span>My account</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ frontendRouter('support') }}">
                            <i data-feather="gift"></i>
                            <span>Support</span>
                        </a>
                    </li>

                    @if (frontendCurrentUser()->user_id == getConfig('user_id-admin'))
                        <li>
                            <a href="{{ frontendRouter('admin-setting') }}">
                                <i data-feather="gift"></i>
                                <span>Admin-Setting</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ frontendRouter('logout') }}">
                            <i data-feather="gift"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <div class="content">

            @yield('content')

        </div> <!-- content -->

    </div>
</div>
<!-- END wrapper -->

<script src="{{ asset('frontend/vendor/jquery3.5/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/app.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/pages/dashboard-1.init.js') }}"></script>
<script src="{{ asset('frontend/vendor/loadingoverlay/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/common.js') }}"></script>

@stack('script')

</body>
</html>
