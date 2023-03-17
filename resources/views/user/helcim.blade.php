@extends('layouts.app')

@section('title', 'Helcim Payment')

@section('dw-li', 'selected')
@section('deposits', 'active')

@section('content')

    @include('user.sidebar')
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
                                    <div class="p-3 text-center">
                                        <h3 class="">You are sending
                                            <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                USD</strong>
                                        </h3>
                                    </div>
                                    <div class="row justify-content-center m-3">
                                        <div class="col-lg-8">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h3 class="">
                                                        <a style="text-decoration:none;" class="collapsed"
                                                            data-toggle="collapse" data-parent="#accordion" href="#helcim">
                                                            <strong>Helcim</strong>
                                                        </a>
                                                    </h3>
                                                    <div id="helcim" class="panel-collapse">
                                                        <!--FORM-->
                                                        <form name="helcimForm" id="helcimForm"
                                                            action="{{ route('starthelcimcharge') }}" method="POST">
                                                            <!--RESULTS-->
                                                            <div id="helcimResults"></div>
                                                            @csrf

                                                            <!--SETTINGS-->
                                                            <input type="hidden" id="token"
                                                                value="c75c73700ca026213c3692">
                                                            <input type="hidden" id="language" value="en">
                                                            {{-- <input type="hidden" id="test" value="1"> --}}

                                                            <!--CARD-INFORMATION-->
                                                            <div class="form-group d-flex justify-content-start col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Credit Card Number*:</h5>
                                                                    <input type="text" id="cardNumber"
                                                                        class="form-control" value="">
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Expiry Month*:</h5>
                                                                    <input type="text" id="cardExpiryMonth"
                                                                        class="form-control" value="" placeholder="08">
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Expiry Year*:</h5>
                                                                    <input type="text" id="cardExpiryYear"
                                                                        class="form-control" value="" placeholder="2026">
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-start col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">CVV*:</h5>
                                                                    <input type="text" id="cardCVV"
                                                                        class="form-control" value="">
                                                                </div>
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Amount*</h5>
                                                                    <input type="text" id="amount"
                                                                        class="form-control" value="{{ $amount*1.4 }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-start col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Card Holder Name*:</h5>
                                                                    <input type="text" id="cardHolderName"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->name ? Auth::user()->name : Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Address*:</h5>
                                                                    <input type="text" id="cardHolderAddress"
                                                                        class="form-control" value="">
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Postal Code*:</h5>
                                                                    <input type="text" id="cardHolderPostalCode"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <input type="button" id="buttonProcess"
                                                                class="btn btn-primary text-center" value="Process"
                                                                onclick="javascript:helcimProcess();">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="https://entrentien-specifique.myhelcim.com/js/version2.js"></script>
    <script defer>
        window.onload = function() {
            var amount = '{{ $amount }}';
            var route = '{{ route('account.liveaccounts') }}';
            // paypalFunc(amount, route);
        }
    </script>
@endsection
