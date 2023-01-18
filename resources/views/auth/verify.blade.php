@extends('layouts.auth')

@section('content')
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
            <button type="submit" class="mt-4 btn btn-primary uk-button uk-button-primary uk-border-rounded">
                {{ __('click here to request another') }}
            </button>
        </div>
    </form>
@endsection
