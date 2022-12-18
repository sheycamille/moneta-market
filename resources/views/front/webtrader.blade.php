@extends('layouts.front')

@section('title', __('message.wtd'))

@section('tools', 'uk-active')
@section('webtrader-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.wtd')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="webtrader-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 style="text-align: center;">@lang('message.webtrader.webtrader_title1')<br>@lang('message.webtrader.webtrader_title2')</h1>
                            <p class="uk-text-lead uk-visible@m" style="font-size: 17px; text-align: center;">
                                @lang('message.webtrader.webtrader_platform')
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h2 class="uk-margin-small-bottom" style="text-align: center;">@lang('message.webtrader.webtrader_sub')</h2>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: center; font-size: 24px; color: #636e72;">@lang('message.webtrader.t7_account')</p>
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
                                            <li>@lang('message.webtrader.indicators')</li>
                                            <li>@lang('message.webtrader.chart_type')</li>
                                            <li>@lang('message.webtrader.one_click')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">
                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.webtrader.interface')</li>
                                            <li>@lang('message.webtrader.chart_layout')</li>
                                            <li>@lang('message.webtrader.data_transmition')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-3-4@m">
                        <div class="uk-grid uk-flex uk-flex-center" data-uk-grid="">
                            <a href="https://web.mobius-trader.com"
                                class="uk-button uk-text-center uk-button-primary uk-border-rounded"
                                style="padding: 15px 60px;">@lang('message.webtrader.btn_2')<i
                                    class="fas fa-angle-right uk-margin-small-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 in-timeline-1">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-4@m uk-grid" data-uk-grid="">
                            <div class="uk-first-column">
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h3>@lang('message.fifthteen')</h3>
                                        <p>@lang('message.global_broker')</p>
                                        <p>@lang('message.growth')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h3>@lang('message.seamless')</h3>
                                        <p>@lang('message.int_awards')</p>
                                        <p> @lang('message.our_work').</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h3>@lang('message.transparency')</h3>
                                        <p>@lang('message.trusted')</p>
                                        <p>@lang('message.commitment').</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h3>@lang('message.best_in_class')</h3>
                                        <p>2018</p>
                                        <p>ForexBrokers.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('front.prod-section')

    </main>

@endsection
