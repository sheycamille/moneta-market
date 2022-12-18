@extends('layouts.front')

@section('title', 'Our Trading Platforms')

@section('platforms-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">Tools</a></li>
                        <li><span>Trading Platforms</span></li>
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
                    <h1 class="text-center">@lang('message.trading_platform.o_t_p')</h1>
                </div>
            </div>
        </section>


        <!--========================== Trader7 Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header">
                            <h3 class="text-left">@lang('metatrader_five')</h3>
                            <h4>@lang('message.trading_platform.advanced_platform')</h4>
                        </div>
                        <p class="text-left">
                            @lang('message.trading_platform.more_features').
                        </p>
                        <div class="text-left">
                            <a class="btn-get-started"
                                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MobiusTrader/MobiusTrader-Mobius.win.exe">@lang('message.trading_platform.download_now')</a><br>
                        </div>
                    </div>
                    <img class="col-md-6" src="{{ asset('front/img/about/MT5-10.jpg') }}" alt="Trader7"
                        tilte="Trader7" />
                </div>
            </div>
        </section>


        <!--========================== Advantages Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header">
                            <h3 class="text-right">@lang('message.trading_platform.benefits')</h3>
                        </div>
                        <p class="text-right">
                            @lang('message.trading_platform.lates_platform').
                        </p>
                        <div class="text-right">
                            <a class="btn-get-started mr-auto" href="{{ route('register') }}">Get Started</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--========================== Our Mobile apps Section ============================-->
        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-header">
                            <h3 class="text-left">@lang('message.trading_platform.mobile_apps')</h3>
                            <h4>@lang('message.trading_platform.freedom')</h4>
                        </div>
                        <p class="text-left">
                            @lang('message.trading_platform.multi_awarded').
                        </p>
                        <div class="text-left">
                            <a class="" target="_blank"
                                href="https://play.google.com/store/apps/details?id=com.mtrader7.terminal&hl=en">
                                <img class="" src="{{ asset('front/img/about/google_play_badge.png') }}"
                                    alt="Andriod Download" tilte="Andriod Download" height="66" />
                                @lang('message.download_now')</a>
                        </div>
                        {{-- <div class="text-left">
                            <a class="" target="_blank"
                                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MobiusTrader/MobiusTrader-Mobius.win.exe">
                                <img class="" src="{{ asset('front/img/about/app-store-en.png') }}"
                                    alt="iPhone Download" tilte="iPhone Download" height="66" />
                                @lang('message.download_now')</a>
                        </div> --}}
                    </div>
                    <img class="col-md-4" src="{{ asset('front/img/about/CT-3533-MobileApp-Redesign-Page-03.png') }}"
                        alt="Our Mobile Apps" tilte="Our Mobile Apps" />
                </div>
            </div>
        </section>


        <!--========================== Get Started ============================-->
        <section id="getstarted">
            <div class="container">
                <div class="col-md-12">
                    <div class="section-header">
                        <h3 class="text-center">@lang('message.trading_platform.get_started')</h3>
                        <div class="text-center">
                            <p>@lang('message.trading_platform.liquid_markets') <em class="cbc_content">1000</em> @lang('message.trading_platform.leading_markets').</p>
                        </div>
                    </div>
                    <div class="howtosteps-block d-flex">
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/icon_register.png') }}"
                                    alt="Register" tilte="Register"
                                    src="{{ asset('front/img/about/icon_register.png') }}"></span><br><br>
                            <h5>@lang('message.trading_platform.register')</h5>
                            <span>
                                <p>@lang('message.trading_platform.sign_up')</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_2-01.png') }}"
                                    alt="Fund" tilte="Fund"
                                    src="{{ asset('front/img/about/ICONS_2-01.png') }}"></span><br><br>
                            <h5>@lang('message.trading_platform.fund')</h5>
                            <span>
                                <p>@lang('message.trading_platform.fund_account').</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_3-01.png') }}"
                                    alt="Trade" tilte="Trade"
                                    src="{{ asset('front/img/about/ICONS_3-01.png') }}"></span><br><br>
                            <h5>@lang('message.trading_platform.trade')</h5>
                            <span>
                                <p>@lang('message.trading_platform.start_trade').</p>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 item active">
                            <span class="ch_img"><img data-src="{{ asset('front/img/about/ICONS_4-01.png') }}"
                                    alt="Withdraw" tilte="Withdraw"
                                    src="{{ asset('front/img/about/ICONS_4-01.png') }}"></span><br><br>
                            <h5>@lang('message.trading_platform.withdraw')</h5>
                            <span>
                                <p>@lang('message.trading_platform.withdraw_profits')</p>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn-get-started" href="{{ route('register') }}">@lang('message.trading_platform.open_an_account')</a><br>
                    </div>
                </div>
                <div class="hw_disclaimer"></div>
            </div>
        </section> <!-- #get started  ends-->

    </main>
@endsection
