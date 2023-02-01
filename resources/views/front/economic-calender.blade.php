@extends('layouts.front')

@section('title', __('message.economic_calender.calender'))

@section('tools', 'uk-active')
@section('calender-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.economic_calender.calender')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="about-us-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center" data-uk-img="">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.economic_calender.calender')</h1>
                            <p class="uk-text-lead uk-text-muted uk-margin-small-top">@lang('message.economic_calender.become')</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <section id="getstarted" class="section-bg wow fadeInUp">
            <div class="container" style="margin: 0 5rem ;">
                <div class="row">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="width: 100%; height: 1000px;">
                        <iframe scrolling="no" allowtransparency="true" frameborder="0"
                            src="https://www.tradingview-widget.com/embed-widget/events/?locale=en#%7B%22width%22%3A%22100%25%22%2C%22height%22%3A%221000%22%2C%22colorTheme%22%3A%22light%22%2C%22isTransparent%22%3Afalse%2C%22importanceFilter%22%3A%22-1%2C0%2C1%22%2C%22utm_source%22%3A%25gestiondupatrimoine.net%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22events%22%7D"
                            style="box-sizing: border-box; height: 1000px; width: 100%;"></iframe>
                        <style>
                            .tradingview-widget-copyright {
                                font-size: 13px !important;
                                line-height: 32px !important;
                                text-align: center !important;
                                vertical-align: middle !important;
                                font-family: 'Trebuchet MS', Arial, sans-serif !important;
                                color: #9db2bd !important;
                            }

                            .tradingview-widget-copyright .blue-text {
                                color: #2962FF !important;
                            }

                            .tradingview-widget-copyright a {
                                text-decoration: none !important;
                                color: #9db2bd !important;
                            }

                            .tradingview-widget-copyright a:visited {
                                color: #9db2bd !important;
                            }

                            .tradingview-widget-copyright a:hover .blue-text {
                                color: #1E53E5 !important;
                            }

                            .tradingview-widget-copyright a:active .blue-text {
                                color: #1848CC !important;
                            }

                            .tradingview-widget-copyright a:visited .blue-text {
                                color: #2962FF !important;
                            }
                        </style>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </section>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid-large uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@m uk-first-column">
                        <h3 class="uk-margin-small-bottom">@lang('message.economic_calender.how_to_use_calender')</h3>
                        <p class="uk-text-lead uk-text-muted uk-margin-remove-top uk-margin-medium-bottom"
                            style="font-size: 1rem;">@lang('message.economic_calender.assist').</p>
                    </div>
                </div>
            </div>
        </div>

        @include('front.prod-section')

    </main>
@endsection
