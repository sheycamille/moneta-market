@extends('layouts.app')

@section('title', 'Change Password')

@section('profile-li', 'selected')
@section('cpassword', 'active')

@section('content')

    @include('user.sidebar')
    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            @lang('message.chgepass.notif')
                        </div>
                        <div class="card-body">
                            <div class="mt-2 mb-5">
                                <h1 class="title1] text-center"> @lang('message.chgepass.change')</h1> <br> <br>
                            </div>
                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <i class="fa fa-info-circle"></i>
                                            <p class="alert-message">{!! Session::get('message') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" clsass="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mb-5 row">
                                <div class="col-lg-8 offset-lg-2 card p-4 shadow-lg">
                                    <form method="post" action="{{ route('updatepass') }}">
                                        <div class="col-4 mb-2">
                                            <h5 class=""> @lang('message.chgepass.old')</h5>
                                            <input type="password" name="old_password" class="form-control" required>
                                        </div>
                                        <div class="col-4 mb-2">
                                            <h5 class=""> @lang('message.chgepass.new')* :</h5>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="col-4 mb-2">
                                            <h5 class=""> @lang('message.chgepass.knfrm')*:</h5>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div> <br>
                                        <input type="submit" class="btn btn-primary" value=" @lang('message.chgepass.sub')">

                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="current_password" value="{{ Auth::user()->password }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"><br />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
