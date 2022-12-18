@extends('layouts.front')

@section('title', __('message.more_freedom'))

@section('home-menu-item', 'uk-active')

@section('content')

    <main>
        <!-- slideshow content begin -->
        <div class="uk-section uk-padding-remove-vertical">
            <div class="in-slideshow uk-visible-toggle" data-uk-slideshow>
                <ul class="uk-slideshow-items">
                    <li>
                        <div class="uk-container">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@m">
                                    <div class="uk-overlay">
                                        <h1>@lang('message.home.get_more1') <span class="in-highlight">@lang('message.home.get_more2')</span> @lang('message.home.get_more3')</h1>
                                        <p class="uk-text-lead uk-visible@m">@lang('message.home.get_more_text')</p>
                                        <div class="in-slideshow-button">
                                            <a href="{{ route('register') }}"
                                                class="uk-button uk-button-primary uk-border-rounded">@lang('message.open_account')</a>
                                            <a href="{{ route('account-types') }}"
                                                class="uk-button uk-button-default uk-border-rounded uk-margin-small-left uk-visible@m">@lang('message.discover_accounts')</a>
                                        </div>
                                        <p class="uk-text-small"><span class="uk-text-primary">*</span>@lang('message.home.forex_warning')</p>
                                    </div>
                                </div>
                                <div class="uk-position-center">
                                    <img class="uk-animation-slide-top-small" src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-slideshow-image-1.png') }}" alt="slideshow-image"
                                        width="862" height="540" data-uk-img>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-container">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@m">
                                    <div class="uk-overlay">
                                        <h1>@lang('message.home.top_broker1') <span class="in-highlight">@lang('message.home.top_broker2')</span> @lang('message.home.top_broker3')</h1>
                                        <p class="uk-text-lead uk-visible@m">@lang('message.home.top_broker_text')</p>
                                        <div class="in-slideshow-button">
                                            <a href="{{ route('register') }}"
                                                class="uk-button uk-button-primary uk-border-rounded">>@lang('message.open_account')</a>
                                            <a href="{{ route('about') }}"
                                                class="uk-button uk-button-default uk-border-rounded uk-margin-small-left uk-visible@m">@lang('message.abt')</a>
                                        </div>
                                        <p class="uk-text-small"><span class="uk-text-primary">*</span>@lang('message.home.forex_warning')</p>
                                    </div>
                                </div>
                                <div class="uk-position-center">
                                    <img class="uk-animation-slide-top-small" src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-slideshow-image-2.png') }}" alt="slideshow-image"
                                        width="862" height="540" data-uk-img>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                    data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next
                    data-uk-slideshow-item="next"></a>
                <div class="uk-container in-slideshow-feature uk-visible@m">
                    <div class="uk-grid uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m">
                            <div class="uk-child-width-1-4" data-uk-grid>
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right">
                                        <i
                                            class="fas fa-drafting-compass in-icon-wrap small circle uk-box-shadow-small"></i>
                                    </div>
                                    <div>
                                        <p class="uk-text-bold uk-margin-remove">@lang('message.home.enhanced_tools')</p>
                                    </div>
                                </div>
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right">
                                        <i class="fas fa-book in-icon-wrap small circle uk-box-shadow-small"></i>
                                    </div>
                                    <div>
                                        <p class="uk-text-bold uk-margin-remove">@lang('message.home.trading_guides')</p>
                                    </div>
                                </div>
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right">
                                        <i class="fas fa-bolt in-icon-wrap small circle uk-box-shadow-small"></i>
                                    </div>
                                    <div>
                                        <p class="uk-text-bold uk-margin-remove">@lang('message.home.fast_execu')</p>
                                    </div>
                                </div>
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right">
                                        <i class="fas fa-percentage in-icon-wrap small circle uk-box-shadow-small"></i>
                                    </div>
                                    <div>
                                        <p class="uk-text-bold uk-margin-remove">0% @lang('message.home.commission')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slideshow content end -->

        <!-- section content begin -->
        <div class="uk-section uk-section-muted in-padding-large-vertical@s in-profit-1">
            <div class="uk-container">
                <div class="uk-grid-divider" data-uk-grid>
                    <div class="uk-width-expand@m in-margin-top-20@s">
                        <h2>@lang('message.home.why_us')</h2>
                        <p>@lang('message.home.why_us_text')</p>
                    </div>
                    <div class="uk-width-2-3@m">
                        <div class="uk-child-width-1-2@s uk-child-width-1-2@m" data-uk-grid>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-margin-right">
                                    <img src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-profit-icon-1.svg') }}" alt="profit-icon"
                                        width="72" height="72" data-uk-img>
                                </div>
                                <div>
                                    <p class="uk-text-bold">@lang('message.home.wide_range')</p>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-margin-right">
                                    <img src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-profit-icon-2.svg') }}" alt="profit-icon"
                                        width="72" height="72" data-uk-img>
                                </div>
                                <div>
                                    <p class="uk-text-bold">@lang('message.home.unparalleled_conditions')</p>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-margin-right">
                                    <img src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-profit-icon-3.svg') }}" alt="profit-icon"
                                        width="72" height="72" data-uk-img>
                                </div>
                                <div>
                                    <p class="uk-text-bold">@lang('message.home.glo_lic_reg')</p>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-margin-right">
                                    <img src="{{ asset('front/img/in-lazy.svg') }}"
                                        data-src="{{ asset('front/img/in-profit-icon-4.svg') }}" alt="profit-icon"
                                        width="72" height="72" data-uk-img>
                                </div>
                                <div>
                                    <p class="uk-text-bold">@lang('message.home.comm_forex_edu')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->

        <!-- section content begin -->
        <div class="uk-section uk-padding-large in-padding-large-vertical@s uk-background-contain in-profit-2"
            data-src="{{ asset('front/img/in-profit-decor-3.svg') }}" data-uk-img>
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-1-2@m uk-text-center">
                        <h2>@lang('message.home.exp_more')</h2>
                        <p class="uk-text-lead">@lang('message.home.exp_more_text')</p>
                        <i class="fas fa-chevron-down uk-text-primary"></i>
                    </div>
                    <div class="uk-width-5-6@m">
                        <div class="uk-child-width-1-2@s uk-child-width-1-2@m uk-margin-medium-top" data-uk-grid>
                            <div>
                                <div class="in-pricing-1">
                                    <div class="uk-card uk-card-default uk-box-shadow-medium">
                                        <div class="uk-card-media-top">
                                            <img class="uk-width-1-1 uk-align-center"
                                                src="{{ asset('front/img/in-lazy.svg') }}"
                                                data-src="{{ asset('front/img/in-profit-content-1.jpeg') }}" data-width
                                                data-height alt="sample-image" data-uk-img>
                                            <span></span>
                                        </div>
                                        <div class="uk-card-body">
                                            <div class="in-heading-extra in-card-decor-1">
                                                <h2 class="uk-margin-remove-bottom">@lang('message.home.economic')</h2>
                                                <p class="uk-text-lead">@lang('message.home.analysis')</p>
                                            </div>
                                            <p class="uk-margin-small-top">@lang('message.home.econ_analy_text')</p>
                                            <div class="uk-margin-medium-top">
                                                <a class="uk-button uk-button-link uk-text-uppercase uk-text-small"
                                                    href="#">@lang('message.home.read_analy')<i
                                                        class="fas fa-caret-square-right uk-margin-small-left"></i></a>
                                                <span class="uk-label uk-border-pill uk-align-right">@lang('message.home.we_upd')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-pricing-1">
                                    <div class="uk-card uk-card-default uk-box-shadow-medium">
                                        <div class="uk-card-media-top">
                                            <img class="uk-width-1-1 uk-align-center"
                                                src="{{ asset('front/img/in-lazy.svg') }}"
                                                data-src="{{ asset('front/img/in-profit-content-2.jpeg') }}" data-width
                                                data-height alt="sample-image" data-uk-img>
                                            <span></span>
                                        </div>
                                        <div class="uk-card-body">
                                            <div class="in-heading-extra in-card-decor-2">
                                                <h2 class="uk-margin-remove-bottom">@lang('message.home.technical')</h2>
                                                <p class="uk-text-lead">@lang('message.home.analysis')</p>
                                            </div>
                                            <p class="uk-margin-small-top">@lang('message.home.tech_analy')</p>
                                            <div class="uk-margin-medium-top">
                                                <a class="uk-button uk-button-link uk-text-uppercase uk-text-small"
                                                    href="#">@lang('message.home.read_analy')<i
                                                        class="fas fa-caret-square-right uk-margin-small-left"></i></a>
                                                <span class="uk-label uk-border-pill uk-align-right">@lang('message.home.dai_upd')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <div class="uk-card uk-card-default uk-card-body in-profit-appcard">
                                    <div class="uk-child-width-1-2@m" data-uk-grid>
                                        <div>
                                            <div data-uk-margin>
                                                <a href="#" class="uk-button in-button-app uk-margin-small-right">
                                                    <i class="fab fa-google-play fa-2x"></i>
                                                    <span class="wrapper">@lang('message.home.down_from')<span>@lang('message.home.play_store')</span></span>
                                                </a>
                                                <a href="#" class="uk-button in-button-app">
                                                    <i class="fab fa-apple fa-2x"></i>
                                                    <span class="wrapper">@lang('message.home.down_from')<span>@lang('message.home.app_store')</span></span>
                                                </a>
                                            </div>
                                            <hr>
                                            <p>@lang('message.home.trade_on1') <span class="uk-text-bold uk-text-primary">@lang('message.home.trade_on2')</span>
                                                    @lang('message.home.trade_on3')</p>
                                        </div>
                                        <div class="uk-visible@m">
                                            <img src="{{ asset('front/img/in-lazy.svg') }}"
                                                data-src="{{ asset('front/img/in-profit-mockup-1.png') }}"
                                                width="450" height="203" alt="profit-mockup" data-uk-img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <div class="uk-grid uk-grid-divider uk-grid-match in-profit-tradestatus" data-uk-grid>
                                    <div class="uk-width-1-1 uk-width-auto@m">
                                        <div class="uk-flex uk-flex-left uk-flex-center@m">
                                            <div class="uk-grid uk-grid-small uk-flex-middle">
                                                <div class="uk-width-auto">
                                                    <i
                                                        class="fas fa-chart-line fa-2x in-icon-wrap circle primary-color"></i>
                                                </div>
                                                <div class="uk-width-expand">
                                                    <h1 class="uk-margin-remove-bottom">324,978,126</h1>
                                                    <p
                                                        class="uk-text-uppercase uk-text-primary uk-text-small uk-margin-remove-top">
                                                        @lang('message.home.trades_opened')</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1 uk-width-expand@m uk-flex-middle">
                                        <p class="uk-text-lead">@lang('message.home.trade_invest')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->

        <!-- section content begin -->
        <div class="uk-section uk-section-secondary uk-padding-large uk-background-contain uk-background-bottom-center in-padding-large-vertical@s in-profit-3"
            data-src="{{ asset('front/img/in-section-profit-3.png') }}" data-uk-img>
            <div class="uk-container uk-margin-small-bottom">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-2@m">
                        <h2>@lang('message.home.we_comm')</h2>
                        <p class="uk-text-lead">@lang('message.home.we_comm_text')</p>
                    </div>
                    <div class="uk-width-1-1">
                        <div class="uk-child-width-1-2@s uk-child-width-1-4@m uk-margin-small-top" data-uk-grid>
                            <div>
                                <h1 class="uk-heading-bullet">
                                    <span class="count" data-counter-end="10">0</span>M+
                                </h1>
                                <p>@lang('message.clients')</p>
                            </div>
                            <div>
                                <h1 class="uk-heading-bullet">
                                    <span class="count" data-counter-end="9">0</span>%
                                </h1>
                                <p>@lang('message.awards')</p>
                            </div>
                            <div>
                                <h1 class="uk-heading-bullet">
                                    <span class="count" data-counter-end="5">0</span>M+
                                </h1>
                                <p>@lang('message.five_star')</p>
                            </div>
                            <div>
                                <h1 class="uk-heading-bullet">
                                    <span class="count" data-counter-end="4">0</span>M+
                                </h1>
                                <p>@lang('message.regulations')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->

        <!-- section content begin -->
        <div class="uk-section uk-padding-large in-padding-large-vertical@s in-profit-4">
            <div class="uk-container uk-margin-small-top uk-margin-medium-bottom">
                <div class="uk-grid uk-flex uk-flex-center " data-uk-grid>
                    <div class="uk-width-5-6@m">
                        <div class="uk-grid uk-flex-middle" data-uk-grid>
                            <div class="uk-width-expand@m">
                                <h2></h2>
                            </div>
                            <div class="uk-width-3-5@m">
                                <p class="uk-text-lead">@lang('message.home.access_more')</p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1">
                        <div class="uk-child-width-1-2@s uk-child-width-1-5@m in-profit-stockprice"
                            data-uk-grid>
                            <div>
                                <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                                    <span class="uk-float-left">
                                        <img src="{{ asset('front/img/in-lazy.svg') }}"
                                            data-src="{{ asset('front/img/in-profit-ticker-1.svg') }}"
                                            alt="profit-ticker" width="77" height="20" data-uk-img>
                                    </span>
                                    <span class="uk-float-right down">
                                        <i class="fas fa-arrow-down"></i>1,526.05
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                                    <span class="uk-float-left">
                                        <img src="{{ asset('front/img/in-lazy.svg') }}"
                                            data-src="{{ asset('front/img/in-profit-ticker-2.svg') }}"
                                            alt="profit-ticker" width="77" height="20" data-uk-img>
                                    </span>
                                    <span class="uk-float-right down">
                                        <i class="fas fa-arrow-down"></i>205.37
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                                    <span class="uk-float-left">
                                        <img src="{{ asset('front/img/in-lazy.svg') }}"
                                            data-src="{{ asset('front/img/in-profit-ticker-3.svg') }}"
                                            alt="profit-ticker" width="77" height="20" data-uk-img>
                                    </span>
                                    <span class="uk-float-right down">
                                        <i class="fas fa-arrow-down"></i>267.97
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                                    <span class="uk-float-left">
                                        <img src="{{ asset('front/img/in-lazy.svg') }}"
                                            data-src="{{ asset('front/img/in-profit-ticker-4.svg') }}"
                                            alt="profit-ticker" width="77" height="20" data-uk-img>
                                    </span>
                                    <span class="uk-float-right up">
                                        <i class="fas fa-arrow-up"></i>59,230
                                    </span>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                                    <span class="uk-float-left">
                                        <img src="{{ asset('front/img/in-lazy.svg') }}"
                                            data-src="{{ asset('front/img/in-profit-ticker-5.svg') }}"
                                            alt="profit-ticker" width="77" height="20" data-uk-img>
                                    </span>
                                    <span class="uk-float-right up">
                                        <i class="fas fa-arrow-up"></i>78.98
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-5-6@m">
                        <div class="uk-grid-large uk-flex-middle" data-uk-grid>
                            <div class="uk-width-auto@m">
                                <h4 class="uk-margin-remove-bottom uk-text-primary">@lang('message.home.ready_2trade')</h4>
                                <p class="uk-margin-remove-top">@lang('message.home.get_stat')</p>
                            </div>
                            <div class="uk-width-expand@m">
                                <form class="uk-grid-small" data-uk-grid action="{{ route('register') }}">
                                    <div class="uk-width-1-1 uk-width-expand@m">
                                        <input name="email" class="uk-input uk-border-rounded" type="text"
                                            placeholder="@lang('message.register.email')">
                                    </div>
                                    <div class="uk-width-1-1 uk-width-expand@m">
                                        <input name="phone" class="uk-input uk-border-rounded" type="text"
                                            placeholder="@lang('message.body.phone')">
                                    </div>
                                    <div class="uk-width-1-1 uk-width-auto@m">
                                        <button class="uk-button uk-button-primary uk-border-rounded uk-width-expand">@lang('message.open_account')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- section content end -->
        {{-- <div class="uk-section in-offset-bottom-40 in-profit-trustpilot">
            <div class="uk-container">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1">
                        <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5406e65db0d04a09e042d5fc"
                            data-businessunit-id="561d886b0000ff0005844fd6" data-style-height="28px"
                            data-style-width="100%" data-theme="light">
                            <a href="#" target="_blank" rel="noopener noreferrer">Trustpilot</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </main>
@endsection
