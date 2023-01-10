@extends('layouts.auth')

@section('title', 'Verify Email')

<style>
    .ul {
        text-align: right;
        padding-top: 8px;
    }

    li{
        display: inline;
    }
    .li-1{
        background-color: #ffab2e;
        padding: 8px;
    }
    .li-2{
        background-color: #ff3ca6;
        padding: 8px;
    }

    li a{
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
    }
</style>

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
                                <div class="">
                                    <ul class="ul">
                                        @if (App::getLocale() == 'en')
                                            <li><a class="li-1" href="{{ route('switchlang', 'fr') }}">FR</a>
                                            </li>
                                            <li><a class="li-2"
                                                    href="{{ route('switchlang', 'es') }}">ES</a>
                                            </li>
                                        @elseif (App::getLocale() == 'fr')
                                            <li><a class="li-1"
                                                    href="{{ route('switchlang', 'en') }}">EN</a>
                                            </li>
                                            <li><a class="li-2"
                                                    href="{{ route('switchlang', 'es') }}">ES</a>
                                            </li>
                                        @else
                                            <li><a class="li-1"
                                                    href="{{ route('switchlang', 'en') }}">EN</a>
                                            </li>
                                            <li><a class="li-2"
                                                    href="{{ route('switchlang', 'FR') }}">FR</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <!-- module logo begin -->
                                <a class="uk-logo" href="{{ route('home') }}">
                                    <img class="in-offset-top-10" src="{{ asset('front/img/group-logo.png') }}"
                                        data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="180"
                                        height="36" data-uk-img>
                                </a>
                                <!-- module logo begin -->

                                <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">{{ $title }}</p>

                                <div class="text-center">
                                    <div class="text-center">
                                        @if (Session::has('message'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <p class="alert-message">{!! Session::get('message') !!}</p>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
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
                                            <button type="submit"
                                                class="mt-4 btn btn-primary uk-button uk-button-primary uk-border-rounded">
                                                {{ __('Resend Verification Email') }}
                                            </button>
                                        </div>
                                    </form>

                                    <form class="uk-grid uk-form" method="POST" action="{{ route('logout') }}">
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

                                        <div class="uk-margin-small uk-width-1-1">
                                            <button
                                                class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                                                type="submit" name="submit">{{ __('Log Out') }}</button>
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
