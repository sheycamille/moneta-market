@extends('layouts.app')

@section('title', 'Manage Site Frontend')

@section("settings", 'c-show')
@section("frontend-control", 'c-active')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header fw-bolder">
                    <h1 class="title1 text-center">
                        Edit Front Page of this site
                    </h1>
                </div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i> {{Session::get('message')}}
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

                    <div class="mb-5 row">
                        <div class="col-12">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="mb-2 nav-item nav-link active" id="nav-contact-tab" data-toggle="tab"
                                        href="#3" role="tab" aria-controls="nav-contact" aria-selected="false">WEBSITE
                                        CONTENTS</a>
                                    <a class="mb-2 nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#4"
                                        role="tab" aria-controls="nav-about" aria-selected="false">IMAGES</a>
                                </div>
                            </nav>

                            <div class="px-3 py-3 tab-content px-sm-0" id="nav-tabContent">
                                {{-- This is the Third Tab Content --}}
                                <div class="tab-pane fade show active card bg-{{Auth('admin')->User()->dashboard_style}} p-3"
                                    id="3" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="boxes">
                                        <div class="row">
                                            @foreach($contents as $content)
                                            <div class="p-1 col-md-3">
                                                <div
                                                    class="card border p-1 bg-{{Auth('admin')->User()->dashboard_style}}">
                                                    <div class="card-body">
                                                        <h5 class="card-title "><strong>{{$content->title}}</strong>
                                                        </h5>
                                                        <p class="card-text ">{{$content->description}}</p>

                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editcont{{$content->id}}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="editcont{{$content->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div
                                                            class="modal-header bg-{{Auth('admin')->User()->dashboard_style}}">
                                                            <h4 class="modal-title" style="text-align:center;">Update
                                                                General Content</h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div
                                                            class="modal-body bg-{{Auth('admin')->User()->dashboard_style}}">
                                                            <form action="{{route('updatecontents')}}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <h5 class=" ">Title of Content</h5>
                                                                    <input type="text" name="title"
                                                                        placeholder="Name of Content"
                                                                        value="{{$content->title}} "
                                                                        class="form-control bg-{{Auth('admin')->User()->dashboard_style}} "
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Content Description</h5>
                                                                    <textarea name="content"
                                                                        placeholder="Describe the content"
                                                                        class="form-control bg-{{Auth('admin')->User()->dashboard_style}} "
                                                                        rows="2"
                                                                        required>{{$content->description}}</textarea>
                                                                </div>
                                                                <input type="hidden" name="id" value="{{$content->id}}">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                {{-- This is the Fouth Tab Content --}}
                                <div class="tab-pane fade card bg-{{Auth('admin')->User()->dashboard_style}} p-3" id="4"
                                    role="tabpanel" aria-labelledby="nav-about-tab">
                                    <div class="boxes">
                                        <div class="row">
                                            @foreach($images as $image)
                                            <div class="p-1 col-md-4">
                                                <div
                                                    class="card border p-1 bg-{{Auth('admin')->User()->dashboard_style}}">
                                                    <img src="{{ asset('storage/photos/'.$image->img_path)}}"
                                                        class="card-img-top w-50" alt="Image">

                                                    <div class="card-body">
                                                        <h5 class="card-title "><strong>{{$image->title}}</strong> </h5>
                                                        <p class="card-text ">{{$image->description}}</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editimg{{$image->id}}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="editimg{{$image->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div
                                                            class="modal-header bg-{{Auth('admin')->User()->dashboard_style}}">
                                                            <h4 class="modal-title" style="text-align:center;">Update
                                                                Image</h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div
                                                            class="modal-body bg-{{Auth('admin')->User()->dashboard_style}}">
                                                            <form action="{{route('updateimg')}}" method="post"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <h5 class="">Title of Image</h5>
                                                                    <input type="text" name="img_title"
                                                                        value="{{$image->title}}"
                                                                        placeholder="Name of Image"
                                                                        class="form-control bg-{{Auth('admin')->User()->dashboard_style}} ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Images Description</h5>
                                                                    <textarea name="img_desc"
                                                                        placeholder="Describe the image"
                                                                        class="form-control bg-{{Auth('admin')->User()->dashboard_style}} "
                                                                        rows="2">{{$image->description}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Image</h5>
                                                                    <input name="image"
                                                                        class="form-control bg-{{Auth('admin')->User()->dashboard_style}} "
                                                                        type="file">
                                                                </div>
                                                                <input type="hidden" name="id" value="{{$image->id}}">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
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
