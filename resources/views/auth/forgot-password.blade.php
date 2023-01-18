@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">@lang('message.forgot_pass.pasreset')</p>
    <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">@lang('message.forgot_pass.ha')
        <a href="{{ route('login') }}">@lang('message.forgot_pass.lgn')</a>
    </p>

    <!-- form begin -->
    <form class="uk-grid uk-form" action="{{ route('password.email') }}" method="post">
        @csrf

        @if ($errors->has('email'))
            <div class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
        <br>

        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
            <input name="email" class="uk-input uk-border-rounded" id="email" value="{{ old('email') }}"
                type="text" placeholder="email@gmail.com">
        </div>


        <div class="uk-margin-small uk-width-1-1">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.forgot_pass.link')</button>
        </div>
    </form>
    <!-- form end -->

@endsection
