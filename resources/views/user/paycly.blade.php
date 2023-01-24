@extends('layouts.app')

@section('title', 'Paycly Payment')

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
                                                    <div id="numpay" class="d-flex justify-content-center col-xs-12">
                                                        <form method="post"
                                                            action="https://portal.online-epayment.com/checkout.do"
                                                            class="form">
                                                            <h3 class=" text-center pt-5 pb-3">
                                                                Personal Details:
                                                            </h3>
                                                            {{-- <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">First Name*</h5>
                                                                    <input type="text" name="fullname"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}"
                                                                        required>
                                                                </div>

                                                                <div class="col-md-5" style="display: inline-block;">
                                                                    <h5 class="">Email*</h5>
                                                                    <input type="text" name="email"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->email }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Address*</h5>
                                                                    <input type="text" name="bill_street_1"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->address }}" required>
                                                                </div>

                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">City*</h5>
                                                                    <input type="text" name="bill_city"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->town }}" required>
                                                                </div>

                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Phone No*</h5>
                                                                    <input type="text" name="bill_phone"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->phone }}" required
                                                                        placeholder="+1...">
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">State*</h5>
                                                                    <input type="text" name="bill_state"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->state }}" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Zip Code*</h5>
                                                                    <input type="text" name="bill_zip"
                                                                        class="form-control"
                                                                        value="{{ Auth::user()->zip_code }}" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Country*</h5>
                                                                    <select name="bill_country" id="country"
                                                                        class="form-control country-select" required>
                                                                        <option>@lang('message.register.chs')</option>
                                                                        @foreach ($countries as $country)
                                                                            <option
                                                                                @if (Auth::user()->country_id == $country->id || Auth::user()->country_id == $country->name) selected @endif
                                                                                value="{{ strtoupper($country->code) }}">
                                                                                {{ ucfirst($country->name) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                            <h3 class=" text-center pt-5 pb-3">
                                                                Card Details:
                                                            </h3>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12">
                                                                <div class="col-md-4" style="display: inline-block;">
                                                                    <h5 class="">Card No*</h5>
                                                                    <input type="text" name="ccno"
                                                                        class="form-control" value="4242424242424242"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">Expiry Month*</h5>
                                                                    <input type="text" name="month" placeholder="01"
                                                                        class="form-control" value="01" required>
                                                                </div>
                                                                <div class="col-md-2" style="display: inline-block;">
                                                                    <h5 class="">Expiry Year*</h5>
                                                                    <input type="text" name="year" placeholder="23"
                                                                        class="form-control" value="30" required>
                                                                </div>
                                                                <div class="col-md-3" style="display: inline-block;">
                                                                    <h5 class="">CVV Number*</h5>
                                                                    <input type="text" name="ccvv"
                                                                        class="form-control" value="123" required>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-group d-flex justify-content-center col-xs-12 d-flex justify-content-center col-xs-12">
                                                                <input type="hidden" name="source_url"
                                                                    value="{{ isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] }}">
                                                                <input type="hidden" name="price"
                                                                    value="{{ $amount }}">
                                                                <input type="hidden" name="api_token"
                                                                    value="{{ config('paycly.api_key') }}">
                                                                <input type='hidden' name='website_id'
                                                                    value='{{ config('paycly.website_id') }}' />
                                                                <input type='hidden' name='acquirer_id'
                                                                    value='AXESFORMATION' />
                                                                <input type='hidden' name='action' value='product' />
                                                                <input type='hidden' name='client_ip'
                                                                    value='{{ $client_id }}' />
                                                                <input type="hidden" name="curr" value="USD">
                                                                <input type="hidden" name="product_name"
                                                                    value="Training Pack {{ Auth::user()->id }}">
                                                                <input type="hidden" name="id_order"
                                                                    value="{{ $id_order }}">
                                                                <input type="hidden" name="currency" value="USD">
                                                                <input type="hidden" name="notify_url"
                                                                    value="{{ route('handlepayclycharge') }}">
                                                                <input type="hidden" name="error_url"
                                                                    value="{{ route('handlepayclycharge') }}">
                                                                <input type="hidden" name="success_url"
                                                                    value="{{ route('handlepayclycharge') }}">
                                                                <input type="hidden" name="checkout_url"
                                                                    value="{{ route('handlepayclycharge') }}">
                                                                <input type='hidden' name='notes'
                                                                    value='Awesome service' /> --}}

                                                            <!--Your Website API Token -->
                                                            <input type='hidden' name='api_token'
                                                                value='MjI4N18yOTE0XzIwMjIxMjIzMjMxNzQy' />

                                                            <!--Your Website Id -->
                                                            <input type='hidden' name='website_id' value='2914' />

                                                            <!--Optional -->
                                                            <input type='hidden' name='acquirer_id' value='' />

                                                            <!--This default (fixed) value can not to be changed -->
                                                            <input type='hidden' name='action' value='product' />

                                                            <!--client_ip - Internet Protocol. This represents the current IP address of the customer carrying out the transaction -->
                                                            <input type='hidden' name='client_ip' value='172.31.11.32' />

                                                            <!--source_url - Url of Product Page -->
                                                            <input type='hidden' name='source_url'
                                                                value='{{ request()->url() }}' />

                                                            <!--product price,curr and product name * by cart total amount -->

                                                            <!--This is the amount to be charged from card -->
                                                            <input type='hidden' name='price' value='100.00' />

                                                            <!--This is the specified currency to charge the card. -->
                                                            <input type='hidden' name='curr' value='USD' />

                                                            <!--This is the specified Product Name to purchased. -->
                                                            <input type='hidden' name='product_name'
                                                                value='TEST - Axes formation' />

                                                            <!--billing details of .* customer -->

                                                            <!--This is the fullname of the full name or the customer -->
                                                            <input type='hidden' name='fullname'
                                                                value='TEST - CANADA INC' />

                                                            <!--This is the email address of the customer. -->
                                                            <input type='hidden' name='email'
                                                                value='info@axesformation.ca' />

                                                            <!--This is the first address of the customer. -->
                                                            <input type='hidden' name='bill_street_1' value='25A Alpha' />

                                                            <!--This is the scened address of the customer. -->
                                                            <input type='hidden' name='bill_street_2'
                                                                value='tagore lane' />

                                                            <!--This is the city of the customer. -->
                                                            <input type='hidden' name='bill_city' value='Jurong' />

                                                            <!--This is the state of the customer. -->
                                                            <input type='hidden' name='bill_state' value='SG' />

                                                            <!--This is the country of the customer for ISO Alpha-2. -->
                                                            <input type='hidden' name='bill_country' value='SG' />

                                                            <!--This is the zip code of the customer. -->
                                                            <input type='hidden' name='bill_zip' value='444444' />

                                                            <!--This is the phone number of the customer. -->
                                                            <input type='hidden' name='bill_phone'
                                                                value='+1(819) 201-1684' />

                                                            <!--This is the unique reference, unique to the particular transaction being carried out. It is generated by the merchant for every transaction -->
                                                            <input type='hidden' name='id_order' value='20230124172723' />

                                                            <!--notify_url is a url you provide, we send by curl method to it after the customer process for completes payment and append by curl the response to it as query parameters ex. https://yourdomain.com/notify.php -->
                                                            <input type='hidden' name='notify_url'
                                                                value='{{ route('handlepayclycharge') }}' />

                                                            <!--success_url is a url you provide, we redirect to it after the customer completes payment and redirect this url with response to it as query parameters ex. https://yourdomain.com/success.php -->
                                                            <input type='hidden' name='success_url'
                                                                value='{{ route('handlepayclycharge') }}' />

                                                            <!--error_url is a url you provide, we redirect to it after the customer failed payment and redirect this url with response to it as query parameters ex. https://yourdomain.com/failed.php -->
                                                            <input type='hidden' name='error_url'
                                                                value='{{ route('handlepayclycharge') }}' />

                                                            <!--checkout_url is a url you provide, Optional ex. https://yourdomain.com/checkout_url.php -->
                                                            <input type='hidden' name='{{ route('handlepayclycharge') }}'
                                                                value='' />

                                                            <!--card details of .* customer -->

                                                            <!--This is the card number on the Debit/Credit card -->
                                                            <input type='hidden' name='ccno'
                                                                value='4242424242424242' />

                                                            <!--Card security code. This is 3/4 digit code at the back of the customers card, used for web payments. -->
                                                            <input type='hidden' name='ccvv' value='123' />

                                                            <!--Two-digit number representing the card's expiration month. -->
                                                            <input type='hidden' name='month' value='01' />

                                                            <!--Two- digit number representing the card's expiration year. -->
                                                            <input type='hidden' name='year' value='30' />

                                                            <!--This comment from customer. -->
                                                            <input type='hidden' name='notes'
                                                                value='Test Note-Remark for this transaction' />

                                                            <!--default value for source and cardsend  -->
                                                            <input type='hidden' name='cardsend' value='CHECKOUT' />
                                                            <input type='hidden' name='source'
                                                                value='Host-Redirect-Card-Payment (Core PHP)' />
                                                            <button class=paynow_link id=paymentsubmit type=submit>PAY
                                                                NOW</button>
                                                            <input type="submit" class="btn btn-primary" value="Submit">
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
