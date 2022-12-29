@extends('layouts.app')

@section('title', 'PayPal Payment')

@section('loadPaypal')
    <script src="https://www.paypal.com/sdk/js?client-id={{ \App\Models\Setting::getValue('pp_ci ') }}&currency=USD">
    </script>
@endsection

@section('dw-li', 'selected')
@section('deposits', 'active')

@section('content')

    @include('user.sidebar')
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
                                <div class="col p-2">
                                    <div class="p-3 text-center">
                                        <h3 class="">You are sending
                                            <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                USD</strong>
                                        </h3>
                                    </div>
                                    <div class="row justify-content-center m-3">
                                        <div class="col-lg-4">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h3 class="">
                                                        <a style="text-decoration:none;" class="collapsed"
                                                            data-toggle="collapse" data-parent="#accordion" href="#paypal">
                                                            <strong>PayPal</strong> <img
                                                                src="{{ asset('home/images/pp.png') }}" width="40px;"
                                                                height="40px;">
                                                        </a>
                                                    </h3>
                                                    <div id="paypal" class="panel-collapse">
                                                        <h4 class="">
                                                            @include('includes.paypal')
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
