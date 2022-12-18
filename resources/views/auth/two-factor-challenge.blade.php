@extends('layouts.auth')

@section('title', 'Two Factor Challenge')

@section('content')
    <main id="main" class="crypto-page">
        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-1@m uk-background-contain uk-background-center-center">
                        <div class="card ">
                            <div class="mb-4 text-center">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-4 text-sm text-center text-dark" x-show="! recovery">
                                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                                </div>

                                <div class="mb-4 text-sm text-center text-dark" x-show="recovery">
                                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                                </div>
                            </div>
                            <form method="POST" action="{{ route('two-factor.login') }}" class="mt-5 card__form">
                                @csrf

                                <div class="mt-4" x-show="! recovery">
                                    <label for="code">{{ __('Code') }}</label>
                                    <input id="code" type="text" inputmode="numeric" class="form-control"
                                        name="code" autofocus x-ref="code" autocomplete="one-time-code">
                                </div>

                                <div class="mt-4" x-show="recovery">
                                    <label for="recovery_code">{{ __('Recovery Code') }}</label>
                                    <input id="recovery_code" class="block w-full mt-1 form-control" type="text"
                                        name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code">
                                </div>

                                <div class="flex items-center justify-end mt-4 text-center">

                                    <button type="button"
                                        class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900 uk-button uk-button-primary uk-border-rounded"
                                        style="justify-content:center" x-show="! recovery"
                                        x-on:click="
                                                        recovery = true;
                                                        $nextTick(() => { $refs.recovery_code.focus() })
                                                    ">
                                        {{ __('Use a recovery code') }}
                                    </button>

                                    <button type="button" class="mt-4 uk-button uk-button-primary uk-border-rounded"
                                        style="justify-content:center" x-show="recovery"
                                        x-on:click="
                                                        recovery = false;
                                                        $nextTick(() => { $refs.code.focus() })
                                                    ">
                                        {{ __('Use an authentication code') }}
                                    </button>

                                    <x-jet-button class="mt-4 uk-button uk-button-primary uk-border-rounded"
                                        style="justify-content:center">
                                        {{ __('Log in') }}
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
