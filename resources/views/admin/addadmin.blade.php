@extends('layouts.app')

@section('title', 'Add Admin')

@section("manage-admins", 'c-show')
@section("admins", 'c-active')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header fw-bolder">
                    Add New Manager
                </div>
                <div class="card-body">

                    @if(Session::has('message'))
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

                    @if(count($errors) > 0)
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

                    <div class="row mb-5">
                        <div class="col-lg-8 offset-lg-2 card p-3">
                            <form method="POST" action="{{ route('saveadmin') }}">

                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <h4 class="">First Name</h4>
                                    <div>
                                        <input id="name" type="text" class="form-control " name="fname"
                                            value="{{ old('fname') }}" required>
                                        @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('l_name') ? ' has-error' : '' }}">
                                    <h4 class="">Last Name</h4>
                                    <div>
                                        <input id="name" type="text" class="form-control " name="l_name"
                                            value="{{ old('l_name') }}" required>
                                        @if ($errors->has('l_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <h4 class="">E-Mail Address</h4>

                                    <div>
                                        <input id="email" type="email" class="form-control " name="email"
                                            value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <h4 class="">Phone number</h4>
                                    <div>
                                        <input id="phone" type="number" class="form-control " name="phone"
                                            value="{{ old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="">Type</h4>
                                    <select class="form-control" name="type">
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <h4 class="">Role</h4>
                                    <select class="form-control" name="roles[]" multiple>
                                        @foreach($roles as $role)
                                             <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select><br>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    <h4 class="">Password</h4>
                                    <div>
                                        <input id="password" type="password" class="form-control " name="password"
                                            required>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <h4 class="">Confirm Password</h4>
                                    <div>
                                        <input id="password-confirm" type="password" class="form-control "
                                            name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-lg px-3">
                                            <i class="fa fa-plus"></i> Save User
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
