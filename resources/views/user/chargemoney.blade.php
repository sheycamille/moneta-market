@extends('layouts.app')

@section('title', 'ChargeMoney Payment')

@section('dw-li', 'selected')
@section('deposits', 'active')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        span.select2.select2-container.select2-container--default {
            max-width: 100%;
            width: 100%;
            border: 0 none;
            border-radius: 5px;
            padding: 3px 0;
            background: white;
            color: #768192;
            font-size: .941rem;
            border: 1px solid #ddd;
            transition: .2s ease-in-out;
            transition-property: color, background-color, border;
        }

        .select2-selection {
            border: 0 none !important;
            border-radius: none !important;
            background-color: white !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #768192;
            line-height: 28px;
        }
    </style>
@endsection

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
                                <div class="col p-1 d-flex justify-content-center">
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
                                                        <form method="post" action="{{ route('startchargemoneycharge') }}"
                                                            enctype="multipart/form-data" class="form">
                                                            <h3 class=" text-center pt-5 pb-3">
                                                                Personal Details:
                                                            </h3>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">First Name*</h5>
                                                                    <input type="text" name="first_name"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->first_name }}" required>
                                                                </div>

                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Last Name*</h5>
                                                                    <input type="text" name="last_name"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->last_name }}" required>
                                                                </div>

                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Email*</h5>
                                                                    <input type="text" name="email"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->email }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Country Phone Code</h5>
                                                                    <input type="text" name="country_code"
                                                                        class="form-control" value="+1">
                                                                </div>

                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Phone No*</h5>
                                                                    <input type="text" name="phone_no"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->phone }}" required>
                                                                </div>

                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Address*</h5>
                                                                    <input type="text" name="address"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->address }}" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">City*</h5>
                                                                    <input type="text" name="city"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->town }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">State*</h5>
                                                                    <input type="text" name="state"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->state }}" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Zip Code*</h5>
                                                                    <input type="text" name="zip"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->zip_code }}" required>
                                                                </div>
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Country*</h5>
                                                                    {{-- <input type="text" name="country"
                                                                    class="form-control"
                                                                    value="{{ Auth::user()->country }}" required> --}}
                                                                    <select class="form-control country-select"
                                                                        name="country" id="country" required>
                                                                        <option selected disabled>Choose Country</option>
                                                                        @foreach ($countries as $country)
                                                                            <option
                                                                                @if (Auth::user()->country->id == $country->id) selected @endif
                                                                                value="{{ strtoupper($country->code) }}">
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
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Card No*</h5>
                                                                    <input type="text" name="card_no"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Expiry Month*</h5>
                                                                    <input type="text" name="ccExpiryMonth"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-2" style="display: inline-block;">
                                                                    <h5 class="">Expiry Year*</h5>
                                                                    <input type="text" name="ccExpiryYear"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">CVV Number*</h5>
                                                                    <input type="text" name="cvvNumber"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex justify-content-start col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Currency*</h5>
                                                                    <input type="text" name="currency"
                                                                        class="form-control" value="USD" required>
                                                                </div>
                                                                <div class="col-md-4" style="display: inline-block;">
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

@section('javascript')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer>
    </script>
    <script type="text/javascript">
        $(function() {
            $('.country-select').select2({
                placeholder: 'Select a country',
                allowClear: true
            })
        })
    </script>
@endsection
