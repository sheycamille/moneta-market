@extends('layouts.app')

@section('title', 'Stripe Payment')

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
                                                        <form role="form" action="{{ route('stripe.post') }}"
                                                            method="post" class="require-validation"
                                                            data-cc-on-file="false"
                                                            data-stripe-publishable-key="{{ config('stripe.api_key') }}"
                                                            id="payment-form">
                                                            @csrf

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group required'>
                                                                    <label class='control-label'>Name on Card</label>
                                                                    <input class='form-control' size='32'
                                                                        type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group required'>
                                                                    <label class='control-label'>Card Number</label>
                                                                    <input autocomplete='off'
                                                                        class='form-control card-number' size='32'
                                                                        type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                    <label class='control-label'>CVC</label> <br><br>
                                                                    <input autocomplete='off' class='form-control card-cvc'
                                                                        placeholder='ex. 311' size='4' type='text'>
                                                                </div>
                                                                <div
                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration Month</label>
                                                                    <input class='form-control card-expiry-month'
                                                                        placeholder='MM' size='2' type='text'>
                                                                </div>
                                                                <div
                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration Year</label>
                                                                    <input class='form-control card-expiry-year'
                                                                        placeholder='YYYY' size='4' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-md-12 error form-group d-none'>
                                                                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row row">
                                                                <input type="hidden" name="amount"
                                                                    value="{{ $amount }}" />
                                                                <input type="hidden" name="name"
                                                                    value="{{ Auth::user()->name }}" />
                                                                <input type="hidden" name="email"
                                                                    value="{{ Auth::user()->email }}" />
                                                                <input type="hidden" name="address"
                                                                    value="{{ Auth::user()->address }}" />
                                                                <input type="hidden" name="town"
                                                                    value="{{ Auth::user()->town }}" />
                                                                <input type="hidden" name="state"
                                                                    value="{{ Auth::user()->state }}" />
                                                                <input type="hidden" name="country"
                                                                    value="{{ strtoupper(Auth::user()->country->code) }}" />
                                                                <input type="hidden" name="zip_code"
                                                                    value="{{ Auth::user()->zip_code }}" />
                                                                <div class="col-xs-12">
                                                                    <button class="btn btn-primary btn-lg btn-block"
                                                                        type="submit">Pay Now
                                                                        (${{ $amount }})</button>
                                                                </div>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection
