@extends('layouts.app')

@section('title', 'Payment Method Selection')

@section('css')
    <style>
        .pricing-table {
            min-height: 196px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pricing-table h2 {}
    </style>
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
                                        <div class="alert alert-success alert-dismissable">
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
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-5">
                                <div class="row text-center d-flex p-4">
                                    {{-- <div class="bs-example widget-shadow table-responsive
                                    data-example-id="hoverable-table"> --}}
                                    @forelse($pmethods as $pmethod)
                                        <div class="col-lg-4 p-4">
                                            <div class="pricing-table purple border">
                                                <img height="150px" width="150px"
                                                    style="margin-left: auto; margin-right:auto; padding-top:5px;"
                                                    src="{{ asset('storage/logos/' . $pmethod->logo) }}"
                                                    alt="{{ $pmethod->logo }}">
                                                <h2 class="">{{ $pmethod->name }}</h2>
                                                <div class="pricing-features">
                                                    <div class="feature">
                                                        @lang('message.body.min'): <span
                                                            class="">{{ \App\Models\Setting::getValue('currency') }}{{ $pmethod->minimum }}</span>
                                                    </div>
                                                    <div class="feature">@lang('message.body.mex'):
                                                        <span
                                                            class="">{{ \App\Models\Setting::getValue('currency') }}{{ $pmethod->maximum }}</span>
                                                    </div>
                                                    <div class="feature">
                                                        @lang('message.body.dur'): <span
                                                            class="">{{ $pmethod->duration }}</span>
                                                    </div>
                                                </div> <br>
                                                <div class="">
                                                    <a class="btn btn-block pricing-action btn-primary nav-pills"
                                                        href="{{ route('startpayment', [$account->id, $pmethod->id]) }}">@lang('message.body.dp')</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="">@lang('message.body.suite') .</p>
                                    @endforelse
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.modals')
@endsection
