@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('dashboard-li', 'selected')
@section('dashboard', 'active')

@section('content')

    @include('admin.sidebar')
    @include('admin.topmenu')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">@lang('message.topmenu.hi')
                    {{ Auth::user()->name }}!</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-muted">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select class="custom-select form-control">
                            <option selected>Aug 19</option>
                            <option value="1">July 19</option>
                            <option value="2">Jun 19</option>
                        </select>
                    </div>
                </div> --}}
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start Earnings & Carousel Widget -->
        <!-- *************************************************************** -->

        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        <h1 class="text-primary pb-2">@lang('message.body.welcome') {{ Auth('admin')->User()->firstName }}
                            {{ Auth('admin')->User()->lastName }}!</h1>
                        <h5 id="ann" class="text-primary op-7 mb-4">{{ \App\Models\Setting::getValue('update') }}
                        </h5>
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

                        @if (auth('admin')->user()->hasPermissionTo('system-reports', 'admin'))
                            <!-- Beginning of  Dashboard Stats  -->
                            <div class="row">

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-success">
                                        <div class="card-body">
                                            <div class="text-value-lg">
                                                @if (!empty($total_deposited))
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $total_deposited }}
                                                @else
                                                    {{ \App\Models\Setting::getValue('currency') }}0.00
                                                @endif
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Total Deposit</small>
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
                                            <div class="text-value-lg">
                                                @if (!empty($pending_deposited))
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $pending_deposited }}
                                                @else
                                                    {{ \App\Models\Setting::getValue('currency') }}0.00
                                                @endif
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Pending
                                                Deposit(s)</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-danger">
                                        <div class="card-body">
                                            <div class="text-value-lg">
                                                @if (!empty($total_withdrawn))
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $total_withdrawn }}
                                                @else
                                                    {{ \App\Models\Setting::getValue('currency') }}0.00
                                                @endif
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Total
                                                Withdrawal</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-warning">
                                        <div class="card-body">
                                            <div class="text-value-lg">
                                                @if (!empty($pending_withdrawn))
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $pending_withdrawn }}
                                                @else
                                                    {{ \App\Models\Setting::getValue('currency') }}0.00
                                                @endif
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Pending
                                                Withdrawals</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <div class="text-value-lg">
                                                <h4 class="card-title">{{ $user_count }}</h4>
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Total Users</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <div class="card text-white bg-danger">
                                        <div class="card-body">
                                            <div class="text-value-lg">
                                                <h4 class="card-title">{{ $blockeusers }}</h4>
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Blocked Users</small>
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
                                            <div class="text-value-lg">
                                                <h4 class="card-title">{{ $activeusers }}</h4>
                                            </div>
                                            <small class="text-uppercase text-white font-weight-bold">Active Users</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
