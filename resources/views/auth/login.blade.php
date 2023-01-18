@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">@lang('message.login.lgn')</p>
    <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">
        @lang('message.login.new')
        <a href="{{ route('register') }}">@lang('message.login.newa')</a>
    </p>

    <div class="mb-4 text-center">
        @if (Session::has('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: auto;">
                {{ session('status') }}
            </div>
        @endif
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- form begin -->
    <form class="uk-grid uk-form" action="{{ route('login') }}" method="post">
        @csrf
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
            <input name="email" class="uk-input uk-border-rounded" id="email" value="" type="text"
                placeholder="email@gmail.com">
        </div>
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
            <input name="password" class="uk-input uk-border-rounded" id="password" value="" type="password"
                placeholder="Password">
        </div>
        <div class="uk-margin-small uk-width-auto uk-text-small">
            <label><input class="uk-checkbox uk-border-rounded" type="checkbox"> @lang('message.login.rmbr')</label>
        </div>
        <div class="uk-margin-small uk-width-expand uk-text-small">
            <label class="uk-align-right"><a class="uk-link-reset"
                    href="{{ route('password.request') }}">@lang('message.login.frgt')</a></label>
        </div>
        <div class="uk-margin-small uk-width-1-1">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.login.sign_in')</button>
        </div>
    </form>
    <!-- form end -->

@endsection
