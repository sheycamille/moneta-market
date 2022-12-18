@extends('layouts.front')

@section('title', __('message.mtd'))

@section('tools', 'uk-active')
@section('trader7-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.mtd')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="trader-page">
        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-8@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.metatrader.metatrader_title1') <br> @lang('message.metatrader.metatrader_title2')</h1>
                            <p class="uk-text-lead uk-text-muted uk-margin-small-top">
                                @lang('message.metatrader.fx_t7')
                            </p>
                            <img src="{{ asset('front/img/t7.jpg') }}" />
                            <br><br>
                            <div class="uk-width-auto">
                                <a class="uk-button uk-button-primary uk-border-rounded"
                                    href="{{ route('register') }}">@lang('message.metatrader.btn_3')</a>
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
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h2 class="uk-margin-small-bottom uk-text-center">@lang('message.metatrader.metatrader_five')</h2>
                            <h4 class="uk-text-center uk-margin-small-top uk-text-muted">@lang('message.metatrader.desktop_platform')</h4>
                            <p class="uk-text-center uk-text-muted uk-margin-remove"
                                style="text-align: center; font-size: 1rem;">@lang('message.metatrader.ea_trading').</p>
                        </div>
                    </div>
                    <div class="uk-width-1-1 in-timeline-1">

                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@m uk-grid" data-uk-grid="">
                            <div class="uk-first-column">
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.metatrader.tech_indicators')</li>
                                            <li>@lang('message.metatrader.charting_tools')</li>
                                            <li>@lang('message.metatrader.frames')</li>
                                            <li>@lang('message.metatrader.order')</li>
                                            <li>@lang('message.metatrader.detachable')</li>
                                            <li>@lang('message.metatrader.from_charts')</li>
                                            <li>@lang('message.metatrader.trailing_stops')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.metatrader.easy_to_use')</li>
                                            <li>@lang('message.metatrader.verification')</li>
                                            <li>@lang('message.metatrader.fully_cus')</li>
                                            <li>@lang('message.metatrader.custom_eas')</li>
                                            <li>@lang('message.metatrader.intergrated_calender')</li>
                                            <li>@lang('message.metatrader.dom')</li>
                                            <li>@lang('message.metatrader.win_mac')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section in-liquid-13">
            <div class="uk-container">
                <div class="uk-grid-large uk-child-width-1-2@m uk-grid" data-uk-grid="">
                    <div>
                        <div class="uk-card uk-card-default uk-border-rounded uk-box-shadow-medium">
                            <div class="uk-card-body">
                                <img src="{{ asset('front/img/t7_tab.jpeg') }}" alt="t7 trader">
                            </div>
                        </div>
                    </div>
                    <div class="uk-first-column">
                        <h4 class="uk-margin-remove">@lang('message.metatrader.download').</h4>
                        <br>
                        <div class="uk-width-auto">
                            <a class="uk-button uk-button-primary uk-border-rounded"
                                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MobiusTrader/MobiusTrader-Mobius.win.exe">@lang('message.metatrader.for_win')</a>
                        </div>
                        <br>
                        <div class="uk-width-auto">
                            <a class="uk-button uk-button-primary uk-border-rounded"
                                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MobiusTrader/MobiusTrader-Mobius.mac.dmg">@lang('message.metatrader.for_mac')</a>
                        </div>
                        <div class="uk-subnav uk-subnav-divider uk-margin-medium-top uk-text-small" data-uk-margin="">
                            <div class="uk-first-column uk-text-muted">@lang('message.metatrader.system_req'):</div>
                            <div class="uk-text-muted uk-margin-small-top">@lang('message.metatrader.compatible').</div>
                            <div class="uk-first-column uk-text-muted">Note:</div>
                            <div class="uk-text-muted uk-margin-small-top">@lang('message.metatrader.netting'),<br> @lang('message.metatrader.hedging').</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="uk-section in-liquid-7 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h2 class="uk-margin-remove">@lang('message.metatrader.meta_for_mobile')</h2>
                            <p class="uk-text-lead uk-text-muted uk-margin-small-top">@lang('message.metatrader.with_fxpro').</p>
                            <br>
                        </div>
                        <div class="uk-grid-medium uk-child-width-1-3@s
uk-child-width-1-3@m uk-text-center uk-margin-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">
                                <img src="{{ asset('front/img/play-market-icon.svg') }}"
                                    data-src="{{ asset('front/img/play-market-icon.svg') }}" alt="wave-award"
                                    style="margin-top: 45%;">
                            </div>
                            <div>
                                <img src="{{ asset('front/img/t7_mobile.jpeg') }}"
                                    data-src="{{ asset('front/img/t7_mobile.jpeg') }}" alt="wave-award" width="500">
                            </div>
                            {{-- <div>
                                <img src="{{ asset('front/img/ios-store-icon.svg') }}"
                                    data-src="{{ asset('front/img/ios-store-icon.svg') }}" alt="wave-award"
                                    style="margin-top: 45%;">
                            </div> --}}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        @include('front.prod-section')

    </main>
@endsection
