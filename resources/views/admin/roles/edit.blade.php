@extends('layouts.app')

@section("manage-admins", 'c-show')
@section("roles", 'c-active')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header fw-bolder">
                    Add New Role
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
                            <form method="POST" action="{{ route('updaterole', $role->id) }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <h4 class=""> Name:</h4>
                                    <input placeholder="Name" class="form-control" name="name" type="text"
                                        value="{{ $role->name }}">
                                </div>
                                <div class="form-group">
                                    <h4>Permission:</h4>
                                    <br />
                                    @foreach($permission as $perm)
                                    <label>
                                        {{ Form::checkbox('permissions[]', $perm->id, in_array($perm->id,
                                        $rolePermissions) ? true : false, array('class' => 'name')) }}
                                        {{ $perm->name }}
                                    </label>
                                    <br />
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-md px-3">
                                            <i class="fa fa-plus"></i> Update Role
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
