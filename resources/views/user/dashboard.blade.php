@extends('layouts.app')

@section('title', 'Dashboard')

@section('dashboard', 'c-active')

@section('css')
    <link href="{{ asset('admin/css/coreui-chartjs.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-left">@lang('message.body.welcome'), {{ Auth::user()->name }}!</h1>
                        </div>

                        <div class="card-body">
                            @if (Session::has('getAnouc') && Session::get('getAnouc') == 'true')
                                @if (\App\Models\Setting::getValue('enable_annoc') == 'on')
                                    <h5 id="ann" class="op-7 mb-4">
                                        {{ \App\Models\Setting::getValue('newupdate') }}</h5>
                                    <script type="text/javascript">
                                        var announment = $("#ann").html();
                                        console.log(announment);
                                        swal({
                                            title: "Annoucement!",
                                            text: announment,
                                            icon: "info",
                                            buttons: {
                                                confirm: {
                                                    text: "Okay",
                                                    value: true,
                                                    visible: true,
                                                    className: "btn btn-info",
                                                    closeModal: true
                                                }
                                            }
                                        });
                                    </script>
                                @endif
                                {{ session()->forget('getAnouc') }}
                            @endif

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
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-stretch flex-row pb-2 pt-2 row">
                                <div class="col-sm-3 col-xs-6 text-center pb-1 p-0">
                                    <a class="btn btn-primary" href="{{ route('account.deposits') }}">
                                        @lang('message.body.depo')
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center pb-1 p-0">
                                    <a class="btn btn-primary" href="{{ route('account.withdrawals') }}">
                                        @lang('message.body.withdraw_funds')
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center pb-1 p-0">
                                    <a class="btn btn-primary" href="{{ route('account.liveaccounts') }}">
                                        @lang('message.body.open')
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center pb-1 p-0">
                                    <a class="btn btn-primary" href="{{ route('account.downloads') }}">
                                        @lang('message.body.downloads')
                                    </a>
                                </div>
                            </div>
                            <br><br>

                            <!-- Beginning of Dashboard Stats  -->
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <div class="text-muted text-right mb-4">
                                                <i class="c-icon c-icon-2xl cil-money c-sidebar-nav-icon"></i>
                                            </div>
                                            <div class="text-value-lg">
                                                @if (!empty($deposited))
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $deposited }}
                                                @else
                                                    {{ \App\Models\Setting::getValue('currency') }}0.00
                                                @endif
                                            </div>
                                            <small class="text-muted text-uppercase font-weight-bold">@lang('message.body.deposited')
                                            </small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-success">
                                        <div class="card-body">
                                            <div class="text-muted text-right mb-4">
                                                <i class="c-icon c-icon-2xl cil-money c-sidebar-nav-icon"></i>
                                            </div>
                                            <div class="text-value-lg">
                                                {{ \App\Models\Setting::getValue('currency') }}{{ number_format($total_balance, 2, '.', ',') }}
                                            </div>
                                            <small class="text-muted text-uppercase font-weight-bold">@lang('message.body.balance')
                                            </small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-info">
                                        <div class="card-body">
                                            <div class="text-muted text-right mb-4">
                                                <i class="c-icon c-icon-2xl cil-money c-sidebar-nav-icon"></i>
                                            </div>
                                            <div class="text-value-lg">
                                                {{ \App\Models\Setting::getValue('currency') }}
                                                {{ number_format($total_bonus, 2, '.', ',') }}
                                            </div>
                                            <small class="text-muted text-uppercase font-weight-bold">@lang('message.body.bonus')
                                            </small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>@lang('message.body.personal_chart') </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="pt-1 col-12">
                                    @include('includes.chart')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
