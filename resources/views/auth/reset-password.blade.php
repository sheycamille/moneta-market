@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">@lang('message.login.newp')</p>

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
    <form class="uk-grid uk-form" action="{{ route('password.update') }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $request->token }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <br>
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
            <input name="email" class="uk-input uk-border-rounded" id="email"
                value="{{ $request->email ?? old('email') }}" type="hidden" placeholder="email@gmail.com" required>
        </div>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <br>
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
            <input name="password" class="uk-input uk-border-rounded" id="password" value="" type="password"
                placeholder="Password" required>
        </div>

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
        <br>
        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
            <input name="password_confirmation" class="uk-input uk-border-rounded" id="password_confirmation" value=""
                type="password" placeholder="Password" required>
        </div>

        <div class="uk-margin-small uk-width-1-1">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.login.rstp')</button>
        </div>
    </form>
    <!-- form end -->

@endsection
