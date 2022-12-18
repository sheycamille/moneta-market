@extends('layouts.front')

@section('title', __('message.fx_calc'))

@section('tools', 'uk-active')
@section('calculator-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.fx_calc')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="calculator-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.fx_calc')</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="background-theme" style="padding: 80px 0!important;">
            <iframe width="100%" frameborder="0" scrolling="no" height="400px"
                src="https://widgets-m.techsubservices.com/en/calculators/all-in-one/9"></iframe>
        </div>

        @include('front.prod-section')

    </main>
@endsection
