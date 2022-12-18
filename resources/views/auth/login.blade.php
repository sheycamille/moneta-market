@extends('layouts.auth')

@section('title', 'Login')

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

                                <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Log into your account</p>
                                <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Don't have an account?
                                    <a href="{{ route('register') }}">Register here</a>
                                </p>

                                <div class="mb-4 text-center">
                                    @if (Session::has('status'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                            style="margin: auto;">
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
                                        <input name="email" class="uk-input uk-border-rounded" id="email"
                                            value="" type="text" placeholder="email@gmail.com">
                                    </div>
                                    <div class="uk-margin-small uk-width-1-1 uk-inline">
                                        <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                        <input name="password" class="uk-input uk-border-rounded" id="password"
                                            value="" type="password" placeholder="Password">
                                    </div>
                                    <div class="uk-margin-small uk-width-auto uk-text-small">
                                        <label><input class="uk-checkbox uk-border-rounded" type="checkbox"> Remember
                                            me</label>
                                    </div>
                                    <div class="uk-margin-small uk-width-expand uk-text-small">
                                        <label class="uk-align-right"><a class="uk-link-reset"
                                                href="{{ route('password.request') }}">Forgot password?</a></label>
                                    </div>
                                    <div class="uk-margin-small uk-width-1-1">
                                        <button
                                            class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                                            type="submit" name="submit">Sign in</button>
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
