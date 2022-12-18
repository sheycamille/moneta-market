@extends('layouts.app')

@section('title', 'Bank Transfer')

@section('deposits-and-withdrawals', 'c-show')
@section('deposits', 'c-active')

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
                                            <p class="alert-message">{!! Session::get('message') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col card p-2">
                                    <div class="p-3 text-center">
                                        <h3 class="">@lang('message.banktransfer.send')
                                            <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                USD</strong> @lang('message.banktransfer.below')
                                        </h3>
                                    </div>
                                    <div class="row justify-content-center m-3">
                                        <div class="col-lg-4">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h3>
                                                        <a style="text-decoration:none;" class="collapsed"
                                                            data-toggle="collapse" data-parent="#accordion" href="#bank">
                                                            <strong>@lang('message.banktransfer.detls') </strong>
                                                        </a>
                                                    </h3>
                                                    <div id="bank" class="panel-collapse">
                                                        <div class="">
                                                            <textarea rows="10" cols="30" style="border: 0;">{!! $dmethod->details !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form class="col-md-4" method="post" action="{{ route('savedeposit') }}"
                                            enctype="multipart/form-data">
                                            <h3 class="">@lang('message.banktransfer.upload').</h3>
                                            <input type="file" name="proof" class="form-control" required>
                                            <br>

                                            <h5 class="">@lang('message.banktransfer.mode'):</h5>
                                            <select name="payment_mode" class="form-control" required>
                                                <option value="{{ $dmethod->name }}">{{ $dmethod->name }}</option>
                                            </select>
                                            <br>
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-primary" value="Submit Proof">
                                        </form>
                                    </div>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
