@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')

    <div class="uk-grid uk-flex">
        @if (Session::has('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: auto;">
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
        <h1>@lang('message.2fa.tfa')</h1>
        <p class="text-muted">
            @lang('message.2fa.email') <a href="{{ route('admin.verify.resend') }}">@lang('message.2fa.here')</a>.
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
                class="uk-input uk-border-rounded {{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required
                autofocus placeholder="@lang('message.2fa.code')" required value="{{ old('two_factor_code') }}"
                id="two_factor_code">
        </div>
        <div class="uk-margin-small uk-width-1-1">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.2fa.rgst')</button>
        </div>
    </form>
    <!-- form end -->

@endsection
