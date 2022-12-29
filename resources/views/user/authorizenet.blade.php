@extends('layouts.app')

@section('title', 'ChargeMoney Payment')

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
                                <div class="col p-2 d-flex justify-content-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h3 class="">Pay
                                                    <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                        USD</strong>
                                                </h3>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div id="chargemoney" class="d-flex justify-content-center col-xs-12">
                                                        <form method="post" action="{{ route('authorizenetdopay') }}"
                                                            enctype="multipart/form-data" class="form col-12">

                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Name on card*</h5>
                                                                    <input type="text" name="owner"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->name }}" required>
                                                                </div>
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Card No*</h5>
                                                                    <input type="text" name="cardNumber"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">CVV Number*</h5>
                                                                    <input type="text" name="cvv"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Expiry Month*</h5>
                                                                    <input type="text" name="expMonth"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Expiry Year*</h5>
                                                                    <input type="text" name="expYear"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-6" style="display: inline-block;">
                                                                    <h5 class="">Amount*</h5>
                                                                    <input type="text" name="amount"
                                                                        class="form-control" value="{{ $amount }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12 d-flex justify-content-center col-xs-12">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                {{-- Hardcoded the currency for authorize.net --}}
                                                                <input type="hidden" name="currency" class="form-control"
                                                                    value="4" required>
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Submit">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
