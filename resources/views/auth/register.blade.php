@extends('layouts.auth')

@section('title', 'Register')

@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        span.select2.select2-container.select2-container--default {
            max-width: 100%;
            width: 100% !important;
            border: 0 none;
            border-radius: 5px;
            padding: 7px 0;
            background: #f7f6fc;
            color: #666;
            font-size: .941rem;
            border: 1px solid #d0d0d0;
            transition: .2s ease-in-out;
            transition-property: color, background-color, border;
        }

        .select2-selection {
            border: 0 none !important;
            border-radius: none !important;
            background-color: #f7f6fc !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .uk-input,
        .uk-select,
        .uk-textarea {
            color: #8d8686 !important;
        }

        .select2-results__option {
            display: block;
        }

        [class*=uk-inline] {
            display: flex;
        }
    </style>
@endsection

@section('content')

    <p class="uk-text-lead uk-margin-remove-top uk-margin-remove-bottom">@lang('message.register.crt')</p>
    <p class="uk-text-small uk-margin-remove-top uk-margin-remove-bottom">@lang('message.register.already')
        <a href="{{ route('login') }}">Login here</a>
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
    <form class="uk-grid uk-form" action="{{ route('register') }}" method="post">
        @csrf

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm" for="first_name"></span>
                <input type="text" class="uk-input uk-border-rounded" name="first_name" value="{{ old('first_name') }}"
                    id="first_name" placeholder="@lang('message.first_name')*" required>
            </div>
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm" for="last_name"></span>
                <input type="text" class="uk-input uk-border-rounded" name="last_name" value="{{ old('last_name') }}"
                    id="last_name" placeholder="@lang('message.last_name')*" required>
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm" for="email"></span>
                <input type="email" class="uk-input uk-border-rounded" name="email"
                    value="{{ old('email', request()->email) }}" id="email" placeholder="@lang('message.register.email')*" required>
            </div>

            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-phone fa-sm" for="phone"></span>
                <input type="mumber" class="uk-input uk-border-rounded" name="phone"
                    value="{{ old('phone', request()->phone) }}" id="phone" placeholder="@lang('message.register.enter_num')*" required>
            </div>
        </div>

        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('account_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('account_type') }}</strong>
                    </span>
                @endif
            </div>

            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-cog fa-sm" for="account_type"></span>
                <select class="uk-input uk-border-rounded" name="account_type" id="account_type" required>
                    <option disabled>Choose account type*</option>
                    @foreach ($account_types as $accType)
                        <option @if ($accType->id == request()->get('account_type')) selected @endif value="{{ $accType->id }}">
                            {{ $accType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-address-card fa-sm" for="address"></span>
                <input type="text" class="uk-input uk-border-rounded" name="address" value="{{ old('address') }}"
                    id="address" placeholder="@lang('message.register.addrs')*" required>
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('town'))
                    <span class="help-block">
                        <strong>{{ $errors->first('town') }}</strong>
                    </span>
                @endif
            </div>
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('zip_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zip_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width-1-1 uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-city fa-sm" for="town"></span>
                <input type="text" class="uk-input uk-border-rounded" name="town" value="{{ old('town') }}"
                    id="town" placeholder="@lang('message.register.town')*" required>
            </div>

            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-map-marker fa-sm" for="zip_code"></span>
                <input type="text" class="uk-input uk-border-rounded" name="zip_code" value="{{ old('zip_code') }}"
                    id="zip_code" placeholder="@lang('message.register.enter_zip')*" required>
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
            </div>

            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('country'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-file fa-sm" for="state"></span>
                <input type="text" class="uk-input uk-border-rounded" name="state" value="{{ old('state') }}"
                    id="state" placeholder="@lang('message.register.enter_stt')*" required>
            </div>

            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-flag fa-sm" for="country" name="country"></span>
                <select name="country" id="country" class="uk-input uk-border-rounded country-select" required>
                    <option>@lang('message.register.chs')*</option>
                    @foreach ($countries as $country)
                        <option @if ($country->id == old('country')) selected @endif value="{{ $country->id }}">
                            {{ ucfirst($country->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="uk-width-1-2 uk-inline">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm" for="password"></span>
                <input type="password" class="uk-input uk-border-rounded" name="password" id="password"
                    placeholder="@lang('message.register.enter_pass')*" required>
            </div>
            <div class="uk-width-1-2 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm" for="confirm-password"></span>
                <input type="password" class="uk-input uk-border-rounded" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" id="confirm-password" placeholder="@lang('message.register.confirm')*"
                    required>
            </div>
        </div>

        <div class="uk-margin-small uk-width uk-inline">
            <div class="uk-width-1-2 uk-inline">
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </div>

        </div>

        <div class="uk-margin-small uk-width-1-1">
            <input type="hidden" class="uk-input uk-border-rounded" name="ref_by"
                value="{{ session()->pull('ref_by') }}">
            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">@lang('message.register.reg')</button>
        </div>
    </form>
    <!-- form end -->

@endsection

@section('scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer>
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script type="text/javascript">
        $(function() {
            $('.country-select').select2({
                placeholder: 'Select a country',
                allowClear: true
            })
        })
    </script>
@endsection
