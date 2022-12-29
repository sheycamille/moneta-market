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
                                                        <form method="post" action="{{ route('startywallitpaycharge') }}"
                                                            enctype="multipart/form-data" class="form">
                                                            <h3 class=" text-center pt-5 pb-3">
                                                                Personal Details:
                                                            </h3>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">First Name*</h5>
                                                                    <input type="text" name="firstName"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->first_name }}" required>
                                                                </div>
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Last Name*</h5>
                                                                    <input type="text" name="lastName"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->last_name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Email*</h5>
                                                                    <input type="text" name="email"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->email }}" required>
                                                                </div>
                                                                {{-- </div>
                                                        <div class="form-group d-flex justify-content-center col-xs-12">
                                                            <div class="col-md-5" style="display: inline-block;">
                                                                <h5 class="">Country Phone Code</h5>
                                                                <input type="text" name="country_code"
                                                                    class="form-control" value="">
                                                            </div> --}}

                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Phone No*</h5>
                                                                    <input type="text" name="phone"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->phone }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Address*</h5>
                                                                    <input type="text" name="address"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->address }}" required>
                                                                </div>
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">City*</h5>
                                                                    <input type="text" name="city"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->town }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">State*</h5>
                                                                    <input type="text" name="state"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->state }}" required>
                                                                </div>
                                                                <div class="col-md-2" style="display: inline-block;">
                                                                    <h5 class="">Zip Code*</h5>
                                                                    <input type="text" name="postal"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->zip_code }}" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Country*</h5>
                                                                    {{-- <input type="text" name="country"
                                                                    class="form-control"
                                                                    value="{{ Auth::user()->country }}" required> --}}
                                                                    <select class="form-control" name="country"
                                                                        id="country" required>
                                                                        <option selected disabled>Choose Country</option>
                                                                        @foreach ($countries as $country)
                                                                            <option
                                                                                @if (Auth::user()->country->id == $country->id) selected @endif
                                                                                value="{{ $country->code }}">
                                                                                {{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select> <br>
                                                                </div>
                                                            </div>

                                                            <h3 class=" text-center pt-5 pb-3">
                                                                Card Details:
                                                            </h3>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Card No</h5>
                                                                    <input type="text" name="cardNumber"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">ExpiryYear</h5>
                                                                    <input type="text" name="expiryYear"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-2" style="display: inline-block;">
                                                                    <h5 class="">ExpiryMonth</h5>
                                                                    <select class="form-control" name="expiryMonth"
                                                                        id="expiryMonth" required>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                        <option>11</option>
                                                                        <option>12</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">CVV Number*</h5>
                                                                    <input type="text" name="csv"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Amount*</h5>
                                                                    <input type="text" name="amount"
                                                                        class="form-control" value="{{ $amount }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12 d-flex justify-content-center col-xs-12">
                                                                <input type="hidden" name="currency" value="4">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
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
