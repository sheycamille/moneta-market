@extends('layouts.app')

@section('title', 'My Profile')

@section('my-account', 'c-show')
@section('my-profile', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            {{ $title }}
                        </div>
                        <div class="card-body">

                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <i class="fa fa-info-circle"></i>
                                            <p class="alert-message">{{ Session::get('message') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="container-fluid">
                                <div class="fade-in">
                                    <div class="row">
                                        <div class="p-2 col-md-8 offset-md-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <h1 class="title1 text-center">@lang('message.body.acnt') </h1>
                                                        <p class="text-capitalize">
                                                            @lang('message.body.type')
                                                            <label
                                                                class="">{{ Auth::user()->accounttype->name }}</label>
                                                        </p>
                                                    </div>

                                                    <form action="{{ route('userprofile') }}" method="POST">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="first_name">@lang('message.first_name')</label>
                                                                <input class="form-control" id="first_name" type="text"
                                                                    name="first_name" placeholder="@lang('message.first_name')"
                                                                    value="{{ Auth::user()->first_name }}">
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="last_name">@lang('message.last_name')</label>
                                                                <input class="form-control" id="last_name" type="text"
                                                                    name="last_name" placeholder="@lang('message.last_name')"
                                                                    value="{{ Auth::user()->last_name }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="email">@lang('message.body.email') </label>
                                                                <input class="form-control" id="email" type="text"
                                                                    name="email" placeholder="@lang('message.body.enter_email')"
                                                                    value="{{ Auth::user()->email }}">
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="dob">@lang('message.dob')</label>
                                                                <input class="form-control" id="dob" type="date"
                                                                    name="dob" placeholder="@lang('message.dob')"
                                                                    value="{{ Auth::user()->dob }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="phone">@lang('message.body.phone')</label>
                                                                <input class="form-control" id="phone" type="text"
                                                                    name="phone" placeholder="@lang('message.body.enter_phone')"
                                                                    value="{{ Auth::user()->phone }}">
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="postal-code">@lang('message.body.zip') /
                                                                    @lang('message.postal_code')</label>
                                                                <input class="form-control" id="postal-code" type="text"
                                                                    placeholder="Zip Code" name="zip_code"
                                                                    value="{{ Auth::user()->zip_code }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="country">@lang('message.register.country')</label>
                                                                <select class="form-control" name="country" id="country"
                                                                    required>
                                                                    <option selected disabled>
                                                                        @lang('message.body.country')
                                                                    </option>
                                                                    @foreach ($countries as $country)
                                                                        <option
                                                                            @if (Auth::user()->country_id == $country->id || Auth::user()->country_id == $country->name) selected @endif
                                                                            value="{{ $country->id }}">
                                                                            {{ ucfirst($country->name) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="address">@lang('message.address')</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    value="{{ Auth::user()->address }}" id="address"
                                                                    placeholder="@lang('message.address')">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label for="state">@lang('message.register.state')</label>
                                                                <input type="text" class="form-control" name="state"
                                                                    value="{{ Auth::user()->state }}" id="state"
                                                                    placeholder="@lang('message.register.enter_stt')">
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="city">@lang('message.body.city')</label>
                                                                <input type="text" class="form-control" name="town"
                                                                    value="{{ Auth::user()->town }}" id="town"
                                                                    placeholder="@lang('message.register.town')">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-center col-xs-12 d-flex justify-content-center col-xs-12">
                                                            <button class="btn btn-sm btn-primary mr-5" type="submit">
                                                                @lang('message.body.submit')</button>
                                                            <button class="btn btn-sm btn-danger" type="reset">
                                                                @lang('message.body.reset')</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('javascript')
<script type="text/javascript">
    $('#country').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.get( "{{url('/get-state-list')}}?country_id=" + countryID, function( data ) {
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(data, function (key, state) {
                    $("#state").append('<option value="' + state.id + '">' + state.name + '</option>');
                });
            });
        } else {
            $("#state").empty();
            $("#town").empty();
        }
    });

    $('#state').on('change', function () {
        var stateID = $(this).val();
        if (stateID) {
            $.get( "{{url('/get-town-list')}}?state_id=" + stateID, function( data ) {
                $("#town").empty();
                $("#town").append('<option>Select</option>');
                $.each(data, function (key, town) {
                    $("#town").append('<option value="' + town.id + '">' + town.name + '</option>');
                });
            });
        } else {
            $("#town").empty();
        }
    });
</script>
@endsection --}}
