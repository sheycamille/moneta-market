@extends('layouts.app')

@section('title', 'My Downloads')


@section('downloads-li', 'selected')
@section('downloads', 'active')

@section('content')

    @include('user.sidebar')
    @include('user.topmenu')


    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <h1>TRADER</h1>
                            <p class="text-center">Download our Trader</p>
                        </div>
                        <div class="card-body">
                            <h4>Web & Mobile Apps</h4>
                            <a href="https://web.monetamarket.net" class="btn btn-primary"
                                target="_blank">@lang('message.launch_webtrader')</a>
                            <a href="https://play.google.com/store/apps/details?id=com.mtrader7.terminal&hl=en"
                                class="btn btn-primary" target="_blank">@lang('message.body.android') </a>
                            <a href="https://apps.apple.com/gb/app/mobiustrader-7/id1355359598" class="btn btn-primary"
                                target="_blank">@lang('message.body.iphone')</a>
                        </div>
                        <div class="card-body">
                            <h4>Desktop Apps</h4>
                            <a href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MonetaMarket/MonetaMarket-Mobius.win.exe"
                                class="btn btn-primary">@lang('message.body.windows')</a>
                            <a href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MonetaMarket/MonetaMarket-Mobius.mac.dmg"
                                class="btn btn-primary">@lang('MacOS')</a>
                            <a href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MonetaMarket/MonetaMarket-Mobius.linux.AppImage"
                                class="btn btn-primary">@lang('Linux')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
