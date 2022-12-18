@extends('layouts.app')

@section('title', 'Contact Us')

@section('support', 'c-active')
@section('my-profile', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">{{ \App\Models\Setting::getValue('site_name') }} Support</h1>
                            <p class="text-center"> @lang('message.body.contact_us')</p>
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

                            <div class="col-md-8 offset-md-2">
                                <form method="post" action="{{ route('enquiry') }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                                    <div class="form-group">
                                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <h5 for="" class="">@lang('message.body.subj') <span
                                                class=" text-danger">*</span>
                                        </h5>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <h5 for="" class="">@lang('message.body.mes')<span
                                                class=" text-danger">*</span>
                                        </h5>
                                        <textarea name="message" class="form-control" rows="5"></textarea>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="">
                                        <input type="submit" class="py-2 btn btn-primary btn-block"
                                            value="@lang('message.body.send')">
                                    </div>
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
@endsection
