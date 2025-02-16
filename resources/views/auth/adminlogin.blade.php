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
    <form method="POST" action="{{ route('adminlogin') }}" class="mt-5 card__form">
        {{ csrf_field() }}

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <br>

        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
            <input name="email" class="uk-input uk-border-rounded" value="{{ old('email') }}" id="email"
                placeholder="name@example.com" required>
        </div>
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
            <input name="password" class="uk-input uk-border-rounded" id="password" value="" type="password"
                placeholder="Password">
        </div>
        <div class="uk-margin-small uk-width-1-1">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.login.sign_in')</button>
        </div>
    </form>
    <!-- form end -->

@endsection
