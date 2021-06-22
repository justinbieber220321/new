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
    <title>Affiliate</title>
    <link rel="stylesheet" href="{{ asset('frontend-new/css/affiliate.css') }}">
</head>
<body>
<div class="container is-affiliate">
    <header>
        <div class="header-inner">
            <div class="logo"><a class="trans logo-image" href="{{ route('trang-chu') }}"><img src="{{ asset('frontend-new/img/common/header_logo.png') }}" alt="RICH" width="127" height="120"></a></div>
            <div class="header-menu js-header-menu sm"><span></span><span></span><span></span></div>
            <nav class="header-navigation js-navigation">
                <ul class="list-navbar">
                    <li class="navbar-item"><a class="navbar-link" href="{{ route('affiliate') }}">AFFILIATE</a></li>
                    <li class="navbar-item"><a class="navbar-link" href="https://insurrance.whalerich.com/policy/">POLICY</a></li>
                    <li class="navbar-item is-submit"><a class="navbar-link" href="{{ frontendRouter('login.get') }}">LOGIN</a></li>
                </ul>
                <div class="header-overlay js-overlay sm"></div>
            </nav>
        </div>
    </header>
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
    <footer>
        <div class="footer-inner">
            <div class="footer-logo"> <img src="{{ asset('frontend-new/img/top/footer_logo.png') }}" alt=""></div>
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
<script src="{{ asset('frontend-new/js/scripts.js') }}"></script>
</body>
</html>