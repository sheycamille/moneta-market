@extends('layouts.front')

@section('title', __('message.account_types'))

@section('company', 'uk-active')
@section('accounts-types-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.company')</a></li>
                        <li><span>@lang('message.account_types')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="about-us-page">

        <!--========================== Heading Section ============================-->
        <div id="about" class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="section-header">
                    <h1 class="text-center">@lang('message.trading_accounts')</h1>
                </div>
            </div>
        </div>


        <!--========================== Account types Section ============================-->
        <div id="pricing" class="uk-section in-liquid-6 in-offset-top-10">

            <div class="uk-container special-cont">

                <header class="section-header">
                    <h3>@lang('message.account_types')</h3>
                    <p>Trade like a pro with any account type</p>
                </header>

                <div class="flex-items-xs-middle flex-items-xs-center" style="margin-top:40px;">
                    <!-- List Account Types  -->
                    @foreach ($account_types as $accType)
                        <div class="col-lg-3 col-md-6 card" style="margin-top:40px;">
                            <div class="pricing-box">
                                <h3>{{ $accType->name }}</h3>
                                <div class="cur">
                                    <h4>${{ $accType->cost }} USD</h4>
                                </div>
                                <div class="price-list">
                                    <ul class="list-unstyled">
                                        <li class="list-item"><i class="bx bx-check"></i>Forex:
                                            {{ $accType->num_fx_pairs }}pairs</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Indices:
                                            {{ $accType->num_indices_pairs }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Commodities:
                                            {{ $accType->num_commodities_pairs }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Trading Platforms:
                                            {{ $accType->trading_platforms }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Trading Model:
                                            {{ $accType->trading_model }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Account Manager:
                                            {{ $accType->account_managr }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Max. Leverage:
                                            {{ $accType->max_leverage }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Min. Trade Size:
                                            {{ $accType->min_trade_size }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Max. Trade Size:
                                            {{ $accType->max_trade_size }} lots</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Typical Spread:
                                            {{ $accType->typical_spread }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Swaps: @if ($accType->swaps)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </li>
                                        <li class="list-item"><i class="bx bx-check"></i>Requotes:
                                            {{ $accType->requotes }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Commission on FX:
                                            {{ $accType->fx_commission }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Min. Possible deposit:
                                            ${{ $accType->cost }} USD</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Execution Type:
                                            {{ $accType->execution_type }}</li>
                                        <li class="list-item"><i class="bx bx-check"></i>Available Instruments:
                                            {{ $accType->available_instruments }}</li>
                                    </ul>
                                </div>
                                <div class="pricing-button">
                                    <a href="/register?account_type={{ $accType->id }}"
                                        class="uk-button uk-button-default uk-border-rounded uk-margin-small-left uk-visible@m">Get
                                        Started</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </main>
@endsection
