@extends('layouts.front')

@section('title', __('message.risk_disclosure.risk'))

@section('tools', 'uk-active')
@section('risk-disclosure-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.risk_disclosure.risk')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="security-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.risk_disclosure.risk')</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom ">
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.declaration')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b1')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect1') </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">
                                @lang('message.risk_disclosure.b2').<br><br>@lang('message.risk_disclosure.b3')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect3')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b4')
                                <br><br>@lang('message.risk_disclosure.b5') <br><br>@lang('message.risk_disclosure.b6')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect3')

                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b7')
                                <br><br>@lang('message.risk_disclosure.b8') <br><br>@lang('message.risk_disclosure.b9')
                                <br><br>@lang('message.risk_disclosure.b10')
                                <br><br>@lang('message.risk_disclosure.b11')<br><br>@lang('message.risk_disclosure.b12')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect4')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b13')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">c)
                                @lang('message.risk_disclosure.sub1')

                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b14').
                                <br><br>@lang('message.risk_disclosure.b15') <br><br>@lang('message.risk_disclosure.b16')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect5')

                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b17')
                                <br><br>@lang('message.risk_disclosure.b18')
                                <br><br>@lang('message.risk_disclosure.b19')<br><br>@lang('message.risk_disclosure.b20')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect6')

                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b21')
                                <br><br>@lang('message.risk_disclosure.b22')
                            </p>
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect7')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b23')
                                <br><br>@lang('message.risk_disclosure.b24')
                            </p>

                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.risk_disclosure.sect8')</h3>
                            <ul class="uk-list uk-list-bullet ">
                                <li> @lang('message.risk_disclosure.b25') </li>
                                <li>
                                    @lang('message.risk_disclosure.b26')
                                </li>
                                <li> @lang('message.risk_disclosure.b27')</li>
                                <li> @lang('message.risk_disclosure.b28')
                                </li>
                                <li>@lang('message.risk_disclosure.b29').</li>
                                <li>@lang('message.risk_disclosure.b30') </li>
                                <li>@lang('message.risk_disclosure.b31') </li>
                                <li>@lang('message.risk_disclosure.b32')
                                </li>
                                <li>@lang('message.risk_disclosure.b33') </li>
                            </ul>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b34')
                            </p>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b35')
                            </p>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.risk_disclosure.b36'):
                            </p>
                            <ul class="uk-list uk-list-bullet ">
                                <li> @lang('message.risk_disclosure.b37')</li>
                                <li> @lang('message.risk_disclosure.b38')
                                </li>
                                <li> @lang('message.risk_disclosure.b39')
                                </li>
                                <li> @lang('message.risk_disclosure.b40')</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
