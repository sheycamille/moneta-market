@extends('layouts.front')

@section('title', __('message.cdt'))

@section('company', 'uk-active')
@section('credit-score-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.company')</a></li>
                        <li><span>@lang('message.cdt')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->


    <main>
        <main id="main" class="credit-score-page">

            <div class="uk-section in-liquid-6 in-offset-top-10">
                <div class="uk-container">
                    <div class="uk-grid uk-flex uk-flex-center">
                        <div class="uk-width-5-6@m uk-background-contain uk-background-center-center" data-uk-img="">
                            <div class="uk-text-center">
                                <h1 class="uk-margin-remove">@lang('message.credit_score.what_is_credit_score')?</h1>
                                <p class="uk-text-lead uk-text-muted uk-margin-small-top">@lang('message.credit_score.an_assesment')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid">
                        <div class="uk-grid uk-grid-large uk-child-width-1-3@m uk-margin-medium-top" data-uk-grid="">
                            <div class="uk-flex uk-flex-left uk-first-column">
                                <div class="uk-margin-right">
                                    <i class="fas fa-leaf fa-lg in-icon-wrap circle primary-color"></i>
                                </div>
                                <div>
                                    <p>@lang('message.credit_score.algorithm')</p>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-left">
                                <div class="uk-margin-right">
                                    <i class="fas fa-hourglass-end fa-lg in-icon-wrap circle primary-color"></i>
                                </div>
                                <div>
                                    <p>@lang('message.credit_score.rates'). <br><br> <span style="color: #b2bec3">@lang('message.credit_score.high_score')</span></p>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-left">
                                <div class="uk-margin-right">
                                    <i class="fas fa-flag fa-lg in-icon-wrap circle primary-color"></i>
                                </div>
                                <div>
                                    <p>@lang('message.credit_score.predict')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid">
                        <div class="uk-width-1-1 uk-flex uk-flex-center">
                            <div class="uk-width-3-4@m uk-text-center">
                                <h2 class="uk-margin-small-bottom"> <span class="in-highlight">Credit Safe</span></h2>
                                <p class="uk-text-lead uk-text-muted uk-margin-remove" style="font-size: 1rem;">
                                    @lang('message.credit_score.creditsafe')</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="uk-section in-liquid-7 in-offset-top-10">
                <div class="uk-container">
                    <div class="uk-grid uk-flex uk-flex-center">
                        <div class="uk-width-5-6@m uk-background-contain uk-background-center-center"
                            style="background-image: url({{ asset('front/img/in-liquid-7-bg.png') }});" data-uk-img="">
                            <div class="uk-text-center">
                                <h2 class="uk-margin-remove">@lang('message.why_trade')</h2>
                                <p class="uk-text-lead uk-text-muted uk-margin-small-top">@lang('message.improve_result')</p>
                            </div>
                            <div class="uk-grid-medium uk-child-width-1-3@s uk-child-width-1-3@m uk-text-center uk-margin-top uk-grid"
                                data-uk-grid="">
                                <div class="uk-first-column">
                                    <img src="{{ asset('front/img/in-liquid-award.svg') }}"
                                        data-src="{{ asset('front/img/in-liquid-award.svg') }}" alt="wave-award"
                                        width="71" height="58" data-uk-img="">
                                    <h6 class="uk-margin-small-top uk-margin-remove-bottom">@lang('message.best_cdf')</h6>
                                    <p class="uk-text-small uk-margin-remove-top">@lang('message.summit')</p>
                                </div>
                                <div>
                                    <img src="{{ asset('front/img/in-liquid-award.svg') }}"
                                        data-src="{{ asset('front/img/in-liquid-award.svg') }}" alt="wave-award"
                                        width="71" height="58" data-uk-img="">
                                    <h6 class="uk-margin-small-top uk-margin-remove-bottom">@lang('message.execution')</h6>
                                    <p class="uk-text-small uk-margin-remove-top">@lang('message.expo')</p>
                                </div>
                                <div>
                                    <img src="{{ asset('front/img/in-liquid-award.svg') }}"
                                        data-src="{{ asset('front/img/in-liquid-award.svg') }}" alt="wave-award"
                                        width="71" height="58" data-uk-img="">
                                    <h6 class="uk-margin-small-top uk-margin-remove-bottom">@lang('message.best_platform')</h6>
                                    <p class="uk-text-small uk-margin-remove-top">@lang('message.london_summit')</p>
                                </div>
                            </div>
                            <img class="uk-align-center" src="{{ asset('front/img/in-liquid-7-mockup.png') }}"
                                data-src="{{ asset('front/img/in-liquid-7-mockup.png') }}" alt="sample-images"
                                width="691" height="420" data-uk-img="">
                            <div class="uk-grid-divider uk-child-width-1-2@s uk-child-width-1-4@m uk-text-center in-offset-top-10 uk-grid"
                                data-uk-grid="">
                                <div class="uk-first-column">
                                    <h2 class="uk-margin-small-bottom">~30ms</h2>
                                    <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">@lang('message.speed')*</p>
                                </div>
                                <div>
                                    <h2 class="uk-margin-small-bottom">24/5</h2>
                                    <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">@lang('message.support')</p>
                                </div>
                                <div>
                                    <h2 class="uk-margin-small-bottom">0.0</h2>
                                    <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">@lang('message.spread')</p>
                                </div>
                                <div>
                                    <h2 class="uk-margin-small-bottom">150+</h2>
                                    <p class="uk-text-small uk-text-uppercase uk-margin-remove-top">@lang('message.instruments')</p>
                                </div>
                            </div>
                            <div class="uk-text-center uk-margin-medium-top">
                                <a class="uk-button uk-button-primary uk-border-rounded uk-margin-small-right"
                                    href="#">@lang('message.creat_account')<i
                                        class="fas fa-angle-right uk-margin-small-left"></i></a>
                                <a class="uk-button uk-button-secondary uk-border-rounded"
                                    href="#">@lang('message.discover')<i
                                        class="fas fa-angle-right uk-margin-small-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-section uk-section-secondary in-liquid-10">
                <div class="uk-container uk-light">
                    <div class="uk-grid-medium uk-child-width-1-3@m uk-flex uk-flex-middle uk-grid" data-uk-grid="">
                        <div class="uk-first-column">
                            <h2>@lang('message.choose_platform')</h2>
                            <p class="uk-text-lead">@lang('message.platforms').</p>
                            <a class="uk-button uk-button-default uk-border-rounded uk-margin-top"
                                href="#">@lang('message.start_trading')<i
                                    class="fas fa-angle-right uk-margin-small-left"></i></a>
                        </div>
                        <div>
                            <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center">
                                <img class="uk-margin-small-bottom"
                                    src="{{ asset('front/img/in-liquid-icon-17.svg') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-17.svg') }}" alt="wave-award"
                                    width="72" height="72" data-uk-img="">
                                <h3 class="uk-margin-top">Moneta Market Trader 7</h3>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center">
                                <img class="uk-margin-small-bottom"
                                    src="{{ asset('front/img/in-liquid-icon-18.svg') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-18.svg') }}" alt="wave-award"
                                    width="72" height="72" data-uk-img="">
                                <h3 class="uk-margin-top">@lang('message.start_trading')</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- section stats begin -->
            <div class="uk-section in-liquid-16">
                <div class="uk-container">
                    <div class="uk-grid uk-flex uk-flex-center">
                        <div class="uk-width-1-2@m uk-text-center">
                            <h2>@lang('message.trade_with') <span class="in-highlight">@lang('message.world_leading')</span> @lang('message.broker').
                            </h2>
                        </div>
                    </div>
                    <div class="uk-grid uk-child-width-1-2@s
uk-child-width-1-4@m uk-text-center"
                        data-uk-grid>
                        <div>
                            <div class="in-liquid-16-counter">
                                <img class="uk-margin-remove" src="{{ asset('front/img/in-lazy.gif') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-22.svg') }}" alt="sample-icon"
                                    width="92" height="92" data-uk-img>
                                <h3 class="uk-text-muted uk-margin-top uk-margin-remove-bottom">
                                    <span class="count" data-counter-end="1000"
                                        data-counter-append=" clients">@lang('message.clients')</span>
                                </h3>
                            </div>
                        </div>
                        <div>
                            <div class="in-liquid-16-counter">
                                <img class="uk-margin-remove" src="{{ asset('front/img/in-lazy.gif') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-24.svg') }}" alt="sample-icon"
                                    width="92" height="92" data-uk-img>
                                <h3 class="uk-text-muted uk-margin-top uk-margin-remove-bottom">
                                    <span class="count" data-counter-end="90"
                                        data-counter-append=" awards">@lang('message.awards')</span>
                                </h3>
                            </div>
                        </div>
                        <div>
                            <div class="in-liquid-16-counter">
                                <img class="uk-margin-remove" src="{{ asset('front/img/in-lazy.gif') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-25.svg') }}" alt="sample-icon"
                                    width="92" height="92" data-uk-img>
                                <h3 class="uk-text-muted uk-margin-top uk-margin-remove-bottom">
                                    <span class="count" data-counter-end="5"
                                        data-counter-append=" customer service">@lang('message.five_star')</span>
                                </h3>
                            </div>
                        </div>
                        <div>
                            <div class="in-liquid-16-counter">
                                <img class="uk-margin-remove" src="{{ asset('front/img/in-lazy.gif') }}"
                                    data-src="{{ asset('front/img/in-liquid-icon-23.svg') }}" alt="sample-icon"
                                    width="92" height="92" data-uk-img>
                                <h3 class="uk-text-muted uk-margin-top uk-margin-remove-bottom">
                                    <span class="count" data-counter-end="4"
                                        data-counter-append=" industry regulations">@lang('message.industry_regulations')<span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    @endsection
