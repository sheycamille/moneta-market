]]@extends('layouts.app')

@section('title', 'User Wallet')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h1 class="text-left">{{ $user }} Wallet Details!</h1>
                    </div>
                    <div class="card-body">
                        <!-- Beginning of Dashboard Stats  -->
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <button class="btn btn-transparent p-0" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <svg class="c-icon">
                                                    <use
                                                        xlink:href="admin/assets/icons/coreui/free-symbol-defs.svg#cui-settings">
                                                    </use>
                                                </svg>
                                            </button>
                                        </div>
                                        @if (!empty($deposited))
                                        <div class="text-value-lg">{{ \App\Models\Setting::getValue('currency') }} {{
                                            $deposited }}</div>
                                        @else
                                        <div class="text-value-lg">{{ \App\Models\Setting::getValue('currency') }}0.00
                                        </div>
                                        @endif
                                        <div>Deposited</div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart1" height="70"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4">
                                <div class="card text-white bg-info">
                                    <div class="card-body pb-0">
                                        <button class="btn btn-transparent p-0 float-right" type="button">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="admin/assets/icons/coreui/free-symbol-defs.svg#cui-location-pin">
                                                </use>
                                            </svg>
                                        </button>
                                        <div class="text-value-lg">{{ \App\Models\Setting::getValue('currency') }}{{
                                            number_format($account_bal, 2, '.', ',') }}</div>
                                        <div>Balance</div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart2" height="70"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-4">
                                <div class="card text-white bg-warning">
                                    <div class="card-body pb-0">
                                        <div class="btn-group float-right">
                                            <button class="btn btn-transparent p-0" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <svg class="c-icon">
                                                    <use
                                                        xlink:href="admin/assets/icons/coreui/free-symbol-defs.svg#cui-settings">
                                                    </use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-value-lg">{{ \App\Models\Setting::getValue('currency') }}
                                            {{ number_format($bonus, 2, '.', ',') }}</div>
                                        <div>Bonus</div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart3" height="70"></canvas>
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
