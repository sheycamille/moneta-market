@extends('layouts.front')

@section('title', 'Our Products')

@section('markets', 'uk-active')
@section('products-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.markets')</a></li>
                        <li><span>Products</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="about-us-page">

        <!--========================== Heading Section ============================-->
        <section id="about" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h1 class="text-center">Our Products</h1>
                </div>
            </div>
        </section>


        <!--========================== Forex Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-left">Forex Trading</h3>
                        </div>
                        <p class="text-left">
                            The foreign exchange is the world’s most liquid and most traded market. When it comes to forex
                            trading with CFDs, you’re effectively buying or selling one against another in an attempt to
                            benefit from long or short term price changes.

                            Moneta Market offers you easy access to trade on the price direction of more than 50 major,
                            minor
                            and exotic pairs from as low as 0.0 spreads.

                            Open an account to BUY or SELL forex CFDs such as the EUR/USD from 0.01 lots in less than 0.01s
                            with Moneta Market's award-winning platforms. Take advantage of our flexible leverage*,
                            leading
                            research and advanced analysis tools.
                        </p>
                        <div class="text-left">
                            <a class="btn-get-started" href="{{ route('register') }}">Start Trading Forex</a><br>
                        </div>
                    </div>
                    <img class="col-md-4" src="{{ asset('front/img/about/Forex_1.png') }}" alt="Forex"
                        tilte="Forex" />
                </div>
            </div>
        </section>


        <!--========================== ETFs Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <img class="col-md-4" src="{{ asset('front/img/about/ETFs_1.png') }}" alt="ETFs" tilte="ETFs" />
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-right">ETFs Trading</h3>
                        </div>
                        <p class="text-right">
                            Exchange Traded Funds are a type of investment fund that tracks a collection of assets like
                            indices, bonds or commodities replicating the collective performance of those assets into a
                            single ETF.

                            ETFs in the form of CFDs combine the benefits and convenience of investing in stocks and those
                            of investing in mutual funds, making them ideal for diversified portfolios.

                            Moneta Market offers over 80 ETFs CFDs from the world’s leading exchanges to trade with
                            direct
                            market access exclusively on our InvestPLUS. All ETFs are set to BUY only and can be traded with
                            up to 1:5 leverage.
                        </p>
                        <div class="text-right">
                            <a class="btn-get-started mr-auto" href="{{ route('register') }}">Start Trading ETFs</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--========================== Commodities Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-left">Commodities Trading</h3>
                        </div>
                        <p class="text-left">
                            Start trading the price movements of the world’s most popular commodities including oil, gas and
                            noble metals against major currencies.

                            A key driver in world markets, commodities can be a highly volatile asset category and are used
                            to diversify traders’ portfolios.

                            Trade long or short on both rising and falling prices with Moneta Market’ flexible leverage*,
                            ultra-low commissions and exceptional execution speeds.

                            Open an account to access our award-winning platforms, professional charting tools, leading
                            market insights and more.
                        </p>
                        <div class="text-left">
                            <a class="btn-get-started" href="{{ route('register') }}">Start Trading Commodities</a><br>
                        </div>
                    </div>
                    <img class="col-md-4" src="{{ asset('front/img/about/Commodities_1.png') }}" alt="Commodities"
                        tilte="Commodities" />
                </div>
            </div>
        </section>


        <!--========================== Shares Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <img class="col-md-4" src="{{ asset('front/img/about/Shares_1.png') }}" alt="Shares"
                        tilte="Shares" />
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-right">Shares Trading</h3>
                        </div>
                        <p class="text-right">
                            Start trading shares CFDs on the world’s biggest brands, including Amazon, Facebook, Apple,
                            Microsoft and Alphabet.

                            Trade long or short on both rising and falling prices with Moneta Market’ flexible leverage*,
                            ultra-low commissions and exceptional execution speeds.

                            Moneta Market offers hundreds of leading shares CFDs, from the world’s biggest exchanges to
                            trade
                            from 0.01 lots in a secure and multi-regulated environment.

                            While we offer over 140 most-traded share CFDs on all our online and Trader 7 platforms, you
                            can find a far larger selection of over 900 shares and ETFs on our InvestPLUS account, available
                            exclusively on the Moneta Market Trader7.
                        </p>
                        <div class="text-right">
                            <a class="btn-get-started mr-auto" href="{{ route('register') }}">Start Trading Shares</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--========================== Indices Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-left">Indices Trading</h3>
                        </div>
                        <p class="text-left">
                            Indices measure the performance of a specific sector or a group of shares of some of the largest
                            and globally acknowledged companies.

                            Trading indices CFDs enables you to speculate on the price movements world’s top financial
                            markets without having to analyse the performance of individual company shares.

                            Start trading CFDs on the word’s leading indices including the S&P500, FTSE and Dow Jones. Buy
                            or Sell indices CFDs with flexible leverage*, ultra-low commissions and exceptional execution
                            speeds.
                        </p>
                        <div class="text-left">
                            <a class="btn-get-started" href="{{ route('register') }}">Start Trading Indices</a><br>
                        </div>
                    </div>
                    <img class="col-md-4" src="{{ asset('front/img/about/Indices_1.png') }}" alt="Indices"
                        tilte="Indices" />
                </div>
            </div>
        </section>


        <!--========================== Cryptocurrency Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <img class="col-md-4" src="{{ asset('front/img/about/Cryptos_1.png') }}" alt="Cryptocurrency"
                        tilte="Cryptocurrency" />
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-right">Cryptocurrency Trading</h3>
                        </div>
                        <p class="text-right">
                            Cryptocurrencies or digital currencies have revolutionised transactions. They are highly
                            volatile, decentralised and used to diversify portfolios.

                            Start trading the price movements of the world’s most popular cryptocurrencies including
                            Bitcoin, Litecoin, Ripple and Ethereum with CFDs. Trade long or short on both rising and falling
                            prices.

                            Moneta Market gives you easy access to crypto trading on award-winning mobile, web and
                            desktop
                            platforms, enabling you to benefit from flexible leverage*, ultra-low spreads and exceptional
                            execution speeds.
                        </p>
                        <div class="text-right">
                            <a class="btn-get-started" href="{{ route('register') }}">Start Trading
                                Cryptocurrency</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--========================== Get Started ============================-->
        <section id="getstarted">
            <div class="container">
                <div class="col-md-12">
                    <div class="section-header">
                        <h3 class="text-center">How to Get Started</h3>
                        <div class="text-center">
                            <p>Access one of the largest and most liquid markets in the world! Enter the world of Forex and
                                CFD online trading in just a few steps and start trading more than <em
                                    class="cbc_content">1000</em> instruments on our world-leading trading platforms.</p>
                        </div>
                    </div>
                    <div class="howtosteps-block d-flex">
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/icon_register.png') }}"
                                    alt="Register" tilte="Register"
                                    src="{{ asset('front/img/about/icon_register.png') }}"></span><br><br>
                            <h5>Register</h5>
                            <span>
                                <p>Sign up and upload your documents to verify your account.</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_2-01.png') }}"
                                    alt="Fund" tilte="Fund"
                                    src="{{ asset('front/img/about/ICONS_2-01.png') }}"></span><br><br>
                            <h5>Fund</h5>
                            <span>
                                <p>Once you understand all the benefits and risks involved, you may fund your account.</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_3-01.png') }}"
                                    alt="Trade" tilte="Trade"
                                    src="{{ asset('front/img/about/ICONS_3-01.png') }}"></span><br><br>
                            <h5>Trade</h5>
                            <span>
                                <p>Start trading on our WebTrader, Desktop or Mobile Platforms.</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_4-01.png') }}"
                                    alt="Withdraw" tilte="Withdraw"
                                    src="{{ asset('front/img/about/ICONS_4-01.png') }}"></span><br><br>
                            <h5>Withdraw</h5>
                            <span>
                                <p>Withdraw any profits or your entire account balance at any time!</p>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn-get-started" href="{{ route('register') }}">Open an Account</a><br>
                    </div>
                </div>
                <div class="hw_disclaimer"></div>
            </div>
        </section> <!-- #get started  ends-->

    </main>
@endsection
