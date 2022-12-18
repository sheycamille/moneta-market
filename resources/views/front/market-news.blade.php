@extends('layouts.front')

@section('title', __('message.frx_nws_page'))

@section('tools', 'uk-active')
@section('news-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.frx_nws_page')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="about-us-page">

        <div class="uk-section uk-margin-small-top">
            <div class="uk-container">
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-2-3@m uk-first-column">
                        <div class="uk-child-width-1-2@m in-blog-1 uk-grid uk-grid-stack" data-uk-grid="">
                            <div class="uk-width-1-1 uk-first-column">
                                <article class="uk-card uk-card-default uk-border-rounded">
                                    <div class="uk-card-body">
                                        <h1>
                                            Forex & Financial News and
                                            Moneta Market Analytics
                                        </h1>
                                    </div>
                                </article>
                            </div>

                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container" style="width: 800px">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                                    {
                                        "feedMode": "all_symbols",
                                        "colorTheme": "light",
                                        "isTransparent": true,
                                        "displayMode": "regular",
                                        "width": "700",
                                        "height": "800",
                                        "locale": "en"
                                    }
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                    <div class="uk-width-expand@m">
                        <!-- widget content begin -->
                        <aside class="uk-margin-medium-bottom">
                            <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                                <h5 class="uk-heading-bullet uk-text-uppercase uk-margin-remove-bottom">Popular</h5>
                                <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                                        {
                                            "feedMode": "market",
                                            "market": "crypto",
                                            "colorTheme": "white",
                                            "isTransparent": true,
                                            "displayMode": "regular",
                                            "width": "300",
                                            "height": "500",
                                            "locale": "en"
                                        }
                                    </script>
                                </div>
                                <!-- TradingView Widget END -->
                            </div>
                        </aside>
                        <!-- widget content end -->
                    </div>
                </div>
            </div>
        </div>

        @include('front.prod-section')

    </main>
@endsection
