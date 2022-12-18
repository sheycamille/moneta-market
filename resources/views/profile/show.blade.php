@extends('layouts.app')

@section('title', 'My Profile')
@section('my-profile', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            Security/Account Deletion
                        </div>
                        <div class="card-body">

                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
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
                            {{-- <div class="row">
                            <div class="col-md-8  col-offset-md-2 p-3">
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')
                                <x-jet-section-border />
                                @endif
                            </div>
                        </div> --}}
                            <div class="row">
                                <div class="col-md-8  col-offset-md-2 p-3">
                                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                        <div>
                                            @livewire('profile.two-factor-authentication-form')
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8  col-offset-md-2 p-3">
                                    <div class="mt-5">
                                        @livewire('profile.logout-other-browser-sessions-form')
                                    </div>

                                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                        <x-jet-section-border />

                                        <div class="mt-5">
                                            @livewire('profile.delete-user-form')
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
