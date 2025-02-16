@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')

    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">{{ $title }}</p>

    <div class="text-center">
        <div class="text-center">
            @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p class="alert-message">{!! Session::get('message') !!}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                @lang('message.login.verfy')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- form begin -->
        <form class="uk-grid uk-form" action="{{ route('verification.send') }}" method="post">
            @csrf
            <div>
                <button type="submit" class="mt-4 btn btn-primary uk-button uk-button-primary uk-border-rounded">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form class="uk-grid uk-form" method="POST" action="{{ route('logout') }}">
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

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                    name="submit">{{ __('Log Out') }}</button>
            </div>
        </form>
        <!-- form end -->
    </div>

@endsection
