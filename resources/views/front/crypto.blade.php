@extends('layouts.front')

@section('title', __('message.crypto_title'))

@section('markets', 'uk-active')
@section('crypto-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.markets')</a></li>
                        <li><span>@lang('message.crypto_title')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="crypto-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.cryptocurrencies.crypto')</h1>
                            <p class="uk-text-lead uk-text-muted uk-margin-small-top">.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section in-liquid-13">
            <div class="uk-container">
                <div class="uk-grid-large uk-child-width-1-2@m uk-grid" data-uk-grid="">
                    <div class="uk-first-column">

                        <h3 class="uk-margin-remove">@lang('message.cryptocurrencies.asset_class')</h3>
                        <ul class="uk-subnav uk-subnav-divider uk-margin-medium-top uk-text-small" data-uk-margin="">
                            <li class="uk-first-column"><i
                                    class="fas fa-money-bill-wave uk-margin-small-right"></i>@lang('message.competitive_pricing')</li>
                            <li><i class="fas fa-shapes uk-margin-small-right"></i>@lang('message.trading_flexibility')</li>
                            <li><i class="fas fa-award uk-margin-small-right"></i>@lang('message.winning_platform')</li>
                        </ul>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-border-rounded uk-box-shadow-medium">
                            <div class="uk-card-body">
                                <table class="uk-table uk-table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('message.markets')</th>
                                            <th>@lang('message.sell')</th>
                                            <th>@lang('message.buy')</th>
                                            <th class="uk-visible@s">@lang('message.change')%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="uk-margin-small-right"
                                                    src="{{ asset('front/img/in-liquid-fxeur.svg') }}"
                                                    data-src="{{ asset('front/img/in-liquid-fxeur.svg') }}" alt="fx-flag"
                                                    width="29" height="17" data-uk-img=""><span
                                                    class="in-pairname">EURUSD</span></td>
                                            <td><span class="uk-label uk-label-danger uk-border-pill">1.09554</span></td>
                                            <td><span class="uk-label uk-label-danger uk-border-pill">1.09555</span></td>
                                            <td class="uk-visible@s">0.1</td>
                                        </tr>
                                        <tr>
                                            <td><img class="uk-margin-small-right"
                                                    src="{{ asset('front/img/in-liquid-fxaud.svg') }}"
                                                    data-src="{{ asset('front/img/in-liquid-fxaud.svg') }}" alt="fx-flag"
                                                    width="29" height="17" data-uk-img=""><span
                                                    class="in-pairname">AUDUSD</span></td>
                                            <td><span class="uk-label uk-label-danger uk-border-pill">0.67017</span></td>
                                            <td><span class="uk-label uk-label-success uk-border-pill">0.67019</span></td>
                                            <td class="uk-visible@s">0.2</td>
                                        </tr>
                                        <tr>
                                            <td><img class="uk-margin-small-right"
                                                    src="{{ asset('front/img/in-liquid-fxjpy.svg') }}"
                                                    data-src="{{ asset('front/img/in-liquid-fxjpy.svg') }}" alt="fx-flag"
                                                    width="29" height="17" data-uk-img=""><span
                                                    class="in-pairname">USDJPY</span></td>
                                            <td><span class="uk-label uk-label-success uk-border-pill">109.792</span></td>
                                            <td><span class="uk-label uk-label-danger uk-border-pill">109.793</span></td>
                                            <td class="uk-visible@s">0.0</td>
                                        </tr>
                                        <tr>
                                            <td><img class="uk-margin-small-right"
                                                    src="{{ asset('front/img/in-liquid-fxcad.svg') }}"
                                                    data-src="{{ asset('front/img/in-liquid-fxcad.svg') }}" alt="fx-flag"
                                                    width="29" height="17" data-uk-img=""><span
                                                    class="in-pairname">USDCAD</span></td>
                                            <td><span class="uk-label uk-label-success uk-border-pill">1.32900</span></td>
                                            <td><span class="uk-label uk-label-success uk-border-pill">1.32909</span></td>
                                            <td class="uk-visible@s">0.3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p class="uk-text-small uk-text-center">@lang('message.platform').</p>
                    </div>
                </div>

            </div>
        </div>

        @include('front.prod-section')

    </main>
@endsection
