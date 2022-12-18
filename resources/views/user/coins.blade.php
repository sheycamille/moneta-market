@extends('layouts.app')

@section('title', 'Coins Payment')

@section('deposits-and-withdrawals', 'c-show')
@section('deposits', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            {{ $title }}
                        </div>
                        <div class="card-body">

                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <i class="fa fa-info-circle"></i>
                                            <p class="alert-message">{!! Session::get('message') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col p-2">
                                    <div class="row justify-content-space-between">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h3 class="">@lang('message.coins.send')
                                                    <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                        USD</strong>
                                                    @lang('message.coins.walet')
                                                </h3>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h3 class="text-center pt-2 pb-3">
                                                        @lang('message.coins.wadrs'):
                                                        <a class="pt-5" style="text-decoration:none;" href="#paypal">
                                                            {{ $wallet_address }}
                                                        </a>
                                                    </h3>
                                                    <div id="paypal">
                                                        <div class="text-center">
                                                            {!! QrCode::size(250)->generate($wallet_address) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <h3 class="">@lang('message.coins.check'){{ $dmethod->name }} @lang('message.coins.to')
                                            </h3>
                                            <div>
                                                <iframe
                                                    src="https://widget.coinlib.io/widget?type=converter&theme=dark&from=usd&to={{ $dmethod->exchange_symbol }}&amount={{ $amount }}"
                                                    width="300px" height="350px" scrolling="auto" marginwidth="0"
                                                    marginheight="0" frameborder="0" border="0"
                                                    style="border:0;margin:auto;padding:0;"></iframe>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <form method="post" action="{{ route('savedeposit') }}"
                                                enctype="multipart/form-data">
                                                <h3 class="">@lang('message.coins.upload')</h3>
                                                <input type="file" name="proof" class="form-control" required>
                                                <br>

                                                <h5 class="">@lang('message.banktransfer.mode'):</h5>
                                                <select name="payment_mode" class="form-control" required>
                                                    <option value="{{ $dmethod->name }}">{{ $dmethod->name }}</option>
                                                </select>
                                                <br>
                                                <input type="hidden" name="amount" value="{{ $amount }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-primary" value="Submit Proof">
                                            </form>
                                        </div>
                                    </div>
                                    <br> <br>

                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <h3 class="text-center">@lang('message.coins.markets')</h3>
                                            <div class="row">
                                                <div
                                                    class="col-6 text-center d-flex justify-content-center align-items-center">
                                                    <a class="text-center"
                                                        href="https://www.binance.com/en/activity/referral-entry/CPA?fromActivityPage=true&ref=CPA_00N7BOAUZ2"
                                                        target="_blank">
                                                        <img src="{{ asset('dash/images/binance.png') }}"
                                                            alt="Buy on Binance" tilte="Buy on Binance" width="80%" />
                                                        <br>
                                                        <span>@lang('message.coins.buy')</span>
                                                    </a>
                                                </div>
                                                <div
                                                    class="col-6 text-center d-flex justify-content-center align-items-center">
                                                    <a class="text-center" href="https://catalyx.io/" target="_blank">
                                                        <img src="{{ asset('dash/images/catalyx.png') }}"
                                                            alt="Buy on Catalyx" tilte="Buy on Catalyx"
                                                            width="80%" />
                                                        <br>
                                                        <span>Buy Now</span>
                                                    </a>
                                                </div>
                                                <div
                                                    class="col-6 text-center d-flex justify-content-center align-items-center">
                                                    <a class="text-center" href="https://crypto.com/" target="_blank">
                                                        <img src="{{ asset('dash/images/crypto-com.png') }}"
                                                            alt="Buy on Crypto.com" tilte="Buy on Crypto.com"
                                                            width="80%" />
                                                        <br>
                                                        <span>@lang('message.coins.buy')</span>
                                                    </a>
                                                </div>
                                                <div
                                                    class="col-6 text-center d-flex justify-content-center align-items-center">
                                                    <a class="text-center" href="https://coinbase.com/join/leonar_0of?src=ios-link" target="_blank">
                                                        <img src="{{ asset('dash/images/coinbase.png') }}"
                                                            alt="Buy on Coinbase" tilte="Buy on Coinbase" width="80%" />
                                                        <br>
                                                        <span>@lang('message.coins.buy')</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
