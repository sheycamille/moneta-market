@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header fw-bolder">
                    <h1 class="title1 text-center">
                        Change my password
                    </h1>
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
                        <div class="col-lg-8 offset-lg-2 p-4">
                            <form method="post" action="{{route('adminupdatepass')}}">
                                <div class="">
                                    <h5 class=" ">Old Password</h5>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                                <div class="">
                                    <h5 class=" ">New Password* </h5>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="">
                                    <h5 class=" ">Confirm Password</h5>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div> <br>
                                <input type="submit" class="btn btn-primary" value="Submit">

                                <input type="hidden" name="id" value="{{Auth('admin')->user()->id}}">
                                <input type="hidden" name="current_password"
                                    value="{{Auth('admin')->User()->password}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"><br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
