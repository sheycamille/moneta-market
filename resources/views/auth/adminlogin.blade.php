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
                                        <input name="email" class="uk-input uk-border-rounded"
                                            value="{{ old('email') }}" id="email" placeholder="name@example.com"
                                            required>
                                    </div>
                                    <div class="uk-margin-small uk-width-1-1 uk-inline">
                                        <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                        <input name="password" class="uk-input uk-border-rounded" id="password"
                                            value="" type="password" placeholder="Password">
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
