@extends('layouts.frontend.frontend-new')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend-new/css/top.css') }}">
@endpush

@push('script')
    <script>
        $(document).ready( function() {
            alert("This site is casino game. Please confirm that you are over 18 years old, and your country allows the game. Don't play more than 180s/day");
        });
    </script>
@endpush

@section('content')
    <main>
        <div class="block-top-keyvisual">
            <div class="keyvisual-slider js-slider-keyvisual">
                <div class="slider-item"><img src="{{ asset('frontend-new/img/top/keyvisual_img_01.jpg') }}" alt="Live Casino"></div>
                <div class="slider-item"> <img src="{{ asset('frontend-new/img/top/keyvisual_img_01.jpg') }}" alt="Live Casino"></div>
                <div class="slider-item"> <img src="{{ asset('frontend-new/img/top/keyvisual_img_01.jpg') }}" alt="Live Casino"></div>
            </div>
        </div>
        <section class="section-top-live">
            <div class="wrapper">
                <h2 class="common-title is-live">LIVE CASINO</h2>
                <div class="tabs-wrapper">
                    <ul class="live-tabs js-tabs">
                        <li class="tab-item is-current" data-tab="tab-first">
                            <div class="item-image text-center"><img src="{{ asset('frontend-new/img/top/PragmaticNew.png') }}" alt="Pragmatic Play"></div>
                            <h3 class="item-title">Pragmatic Play</h3>
                        </li>
                        <li class="tab-item">
                            <a href="https://play.whalerich.com/live-casino/ezugi" target="_blank">
                                <div class="item-image text-center"><img src="{{ asset('frontend-new/img/top/nuxgen_ezugi.png') }}" alt="Ezugi"></div>
                                <h3 class="item-title">Ezugi</h3>
                            </a>
                        </li>
                        <li class="tab-item">
                            <a href="https://play.whalerich.com/live-casino/evolution" target="_blank">
                                <div class="item-image text-center"><img src="{{ asset('frontend-new/img/top/evolution.jpg') }}" alt="Evolution"></div>
                                <h3 class="item-title">Evolution</h3>
                            </a>
                        </li>
                        <li class="tab-item">
                            <a href="https://play.whalerich.com/live-casino/tvbet" target="_blank">
                                <div class="item-image text-center"><img src="{{ asset('frontend-new/img/top/tvbet.jpg') }}" alt="TV Bet"></div>
                                <h3 class="item-title">TV Bet</h3>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tabs-content js-tab-content is-current">
                    <div class="tab-content is-current" id="tab-first">
                        <div class="tabs-inner cards-wrapper">
                            <ul class="list-cards">
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/853" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/801.png') }}" alt="Live - Mega Wheel">
                                            <span class="item-label">Pragmatic Play</span></div>
                                        <h3 class="item-title">Live - Mega Wheel</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/861" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/203.png') }}" alt="Live - Speed Roulette">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Speed Roulette</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/863" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/101.png') }}" alt="Live - Lobby">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Lobby</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/859" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/859.png') }}" alt="Live - Roulette A">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Roulette A</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/852" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/852.png') }}" alt="Live - Mega Sic Bo">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Mega Sic Bo</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/858" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/858.png') }}" alt="Live - Mega Roulette">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Mega Roulette</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/864" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/864.png') }}" alt="Live - Lobby BJ">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Lobby BJ</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="trans" href="https://play.whalerich.com/slots/857" target="_blank">
                                        <div class="item-image">
                                            <img src="{{ asset('frontend-new/img/top/857.png') }}" alt="Live - Baccarat A">
                                            <span class="item-label">Pragmatic</span></div>
                                        <h3 class="item-title">Live - Baccarat A</h3>
                                    </a>
                                </li>
                            </ul>
                            <div class="btn-show-more"><a class="trans" target="_blank" href="https://play.whalerich.com/slots?provider=Pragmatic&category=Live">Show More</a></div>
                        </div>
                    </div>
                    <div class="tab-content" id="tab-second">
                        <div class="tabs-inner cards-wrapper">
                            <ul class="list-cards">
                            </ul>
                            <div class="btn-show-more"><a class="trans" target="_blank" href="https://play.whalerich.com/live-casino/ezugi">Show More</a></div>
                        </div>
                    </div>
                    <div class="tab-content" id="tab-third">
                        <div class="tabs-inner cards-wrapper">
                            <ul class="list-cards">
                            </ul>
                            <div class="btn-show-more"><a class="trans" target="_blank" href="https://play.whalerich.com/live-casino/evolution">Show More</a></div>
                        </div>
                    </div>
                    <div class="tab-content" id="tab-fourth">
                        <div class="tabs-inner cards-wrapper">
                            <div class="btn-show-more"><a class="trans" target="_blank" href="https://play.whalerich.com/live-casino/tvbet">Show More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-top-game">
            <div class="wrapper">
                <h2 class="common-title is-game">CASINO GAMES </h2>
                <div class="cards-wrapper">
                    <ul class="list-cards">
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_01.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_01.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_02.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_01.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_03.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_04.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_01.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_05.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_03.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_04.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_01.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                        <li><a class="trans" href="#">
                                <div class="item-image"><img src="{{ asset('frontend-new/img/top/game_img_05.jpg') }}" alt="Live - Mega Weel"><span class="item-label">Pragmatic Play</span></div>
                                <h3 class="item-title">Live - Mega Weel</h3></a></li>
                    </ul>
                    <div class="btn-show-more"><a class="trans" href="#">Show More</a></div>
                </div>
            </div>
        </section>
        <section class="section-top-providers">
            <div class="wrapper">
                <h2 class="common-title is-providers">GAMES PROVIDERS</h2>
                <ul class="list-providers">
                    <li class="item"> <a class="trans" href="#">
                            <div class="item-image"><img src="{{ asset('frontend-new/img/top/providers_img_01.jpg') }}" alt="GAMES PROVIDERS"></div></a></li>
                    <li class="item"> <a class="trans" href="#">
                            <div class="item-image"><img src="{{ asset('frontend-new/img/top/providers_img_01.jpg') }}" alt="GAMES PROVIDERS"></div></a></li>
                    <li class="item"> <a class="trans" href="#">
                            <div class="item-image"><img src="{{ asset('frontend-new/img/top/providers_img_01.jpg') }}" alt="GAMES PROVIDERS"></div></a></li>
                </ul>
            </div>
        </section>
        <section class="section-top-news">
            <div class="wrapper">
                <h2 class="common-title is-news">NEWS</h2>
                <div class="news-content">
                    <div class="block-left"><a class="trans news-item" href="#">
                            <div class="item-image"> <img src="{{ asset('frontend-new/img/top/news_img_01.jpg') }}" alt="Gambling Spells: Enchanting spells to attract luck in the casino"></div>
                            <div class="item-detail">
                                <h3 class="item-title">Gambling Spells: Enchanting spells to attract luck in the casino</h3>
                                <time class="item-time">19/05/2021</time>
                                <p class="item-text">Luck and strategy aren’t the only ways for you to win your gamble. Cast a spell on your wager and attract luck in your favour</p>
                            </div></a></div>
                    <div class="block-right">
                        <ul class="list-items">
                            <li class="news-item"><a class="trans" href="#">
                                    <div class="item-image"> <img src="{{ asset('frontend-new/img/top/news_img_02.jpg') }}" alt="Gambling Spells: Enchanting spells to attract luck in thE"></div>
                                    <div class="item-detail">
                                        <h3 class="item-title">Gambling Spells: Enchanting spells to attract luck in thE</h3>
                                        <time class="item-time">19/05/2021</time>
                                    </div></a></li>
                            <li class="news-item"><a class="trans" href="#">
                                    <div class="item-image"> <img src="{{ asset('frontend-new/img/top/news_img_02.jpg') }}" alt="Gambling Spells: Enchanting spells to attract luck in thE"></div>
                                    <div class="item-detail">
                                        <h3 class="item-title">Gambling Spells: Enchanting spells to attract luck in thE</h3>
                                        <time class="item-time">19/05/2021</time>
                                    </div></a></li>
                            <li class="news-item"><a class="trans" href="#">
                                    <div class="item-image"> <img src="{{ asset('frontend-new/img/top/news_img_02.jpg') }}" alt="Gambling Spells: Enchanting spells to attract luck in thE"></div>
                                    <div class="item-detail">
                                        <h3 class="item-title">Gambling Spells: Enchanting spells to attract luck in thE</h3>
                                        <time class="item-time">19/05/2021</time>
                                    </div></a></li>
                            <li class="news-item"><a class="trans" href="#">
                                    <div class="item-image"> <img src="{{ asset('frontend-new/img/top/news_img_02.jpg') }}" alt="Gambling Spells: Enchanting spells to attract luck in thE"></div>
                                    <div class="item-detail">
                                        <h3 class="item-title">Gambling Spells: Enchanting spells to attract luck in thE</h3>
                                        <time class="item-time">19/05/2021</time>
                                    </div></a></li>
                        </ul>
                        <div class="news-link"> <a class="trans" href="#">Xem thêm </a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection