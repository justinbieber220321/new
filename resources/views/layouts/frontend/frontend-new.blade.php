<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]><meta http-equiv="cleartype" content="on"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0" id="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Live Casino</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo1.png') }}">
    @stack('style')
</head>

<style>
    .container {
        max-width: 100%;
    }

    footer {
        background-size: contain;
    }
</style>

<body>

<div class="container is-home">
    <header>
        <div class="header-inner">
            <h1 class="logo"><a class="trans logo-image" href="https://whalerich.com/"><img src="{{ asset('frontend-new/img/common/header_logo.png') }}" alt="RICH" width="127" height="120"></a></h1>
            <div class="header-menu js-header-menu sm"><span></span><span></span><span></span></div>
            <nav class="header-navigation js-navigation">
                <ul class="list-navbar">
                    <li class="navbar-item"><a class="navbar-link" href="https://whalerich.com/">HOME</a></li>
                @if (frontendIsLogin())
                        <li class="navbar-item"><a class="navbar-link" href="https://insurrance.whalerich.com/policy/">POLICY</a></li>
                        <li class="navbar-item"><a class="navbar-link" href="{{ frontendRouter('home') }}">DASHBOARD</a></li>
                    @endif
                    <li class="navbar-item"><a class="navbar-link" href="{{ route('affiliate') }}">AFFILIATE</a></li>
                </ul>
                <div class="header-overlay js-overlay sm"></div>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="footer-inner">
            <div class="footer-logo"> <img src="{{ asset('frontend-new/img/common/footer_logo.png') }}" alt=""></div>
            <div class="footer-detail">
                <h2 class="detail-title">FOLLOW US</h2>
                <ul class="list-social">
                    <li class="item-social"><a class="trans" href="#" target="_blank" rel="noopener"> <img src="{{ asset('frontend-new/img/common/ico_instagram.png') }}" alt="instagram"></a></li>
                    <li class="item-social"><a class="trans" href="#" target="_blank" rel="noopener"> <img src="{{ asset('frontend-new/img/common/ico_facebook.png') }}" alt="facebook"></a></li>
                    <li class="item-social"><a class="trans" href="#" target="_blank" rel="noopener"> <img src="{{ asset('frontend-new/img/common/ico_twitter.png') }}" alt="twitter"></a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ asset('frontend-new/js/scripts.js') }}"></script>
@stack('script')
</body>
</html>
