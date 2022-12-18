@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')

    <!-- section content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container uk-container-expand">
            <div class="uk-grid" data-uk-height-viewport="expand: true">
                <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge"
                    style="background-image: url({{ asset('front/img/in-signin-image.jpeg') }});">
                </div>
                <div class="uk-width-expand@m uk-flex uk-flex-middle">
                    <div class="uk-grid uk-flex-center">
                        <div class="uk-width-3-5@m">
                            <div class="in-padding-horizontal@s">
                                <!-- module logo begin -->
                                <a class="uk-logo" href="{{ route('home') }}">
                                    <img class="in-offset-top-10" src="{{ asset('front/img/group-logo.png') }}"
                                        data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="130"
                                        height="36" data-uk-img>
                                </a>
                                <!-- module logo begin -->

                                <div class="uk-grid uk-flex">
                                    @if (Session::has('message'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                            style="margin: auto;">
                                            <p class="alert-message">{!! Session::get('message') !!}</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <!-- form begin -->
                                <form method="POST" action="{{ route('verify.store') }}" class="mt-5 card__form">
                                    {{ csrf_field() }}
                                    <h1>Two Factor Verification</h1>
                                    <p class="text-muted">
                                        You have received an email which contains two factor login code.
                                        If you haven't received it, press <a
                                            href="{{ route('admin.verify.resend') }}">here</a>.
                                    </p>

                                    @if ($errors->has('two_factor_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('two_factor_code') }}</strong>
                                        </span>
                                    @endif
                                    <br>

                                    <div class="uk-margin-small uk-width-1-1 uk-inline">
                                        <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                        <input name="two_factor_code"
                                            class="uk-input uk-border-rounded {{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}"
                                            required autofocus placeholder="Two Factor Code" required
                                            value="{{ old('two_factor_code') }}" id="two_factor_code">
                                    </div>
                                    <div class="uk-margin-small uk-width-1-1">
                                        <button
                                            class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                                            type="submit" name="submit">Verify</button>
                                    </div>
                                </form>
                                <!-- form end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- section content end -->

@endsection
