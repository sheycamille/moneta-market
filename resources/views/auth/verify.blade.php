@extends('layouts.auth')

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
                                        data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="180"
                                        height="36" data-uk-img>
                                </a>
                                <!-- module logo begin -->

                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},


                                <!-- form begin -->

                                <form class="uk-grid uk-form" action="{{ route('verification.resend') }}" method="post">
                                    @csrf
                                    <div>
                                        <button type="submit"
                                            class="mt-4 btn btn-primary uk-button uk-button-primary uk-border-rounded">
                                            {{ __('click here to request another') }}
                                        </button>
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
