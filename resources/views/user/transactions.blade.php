@extends('layouts.app')

@section('title', 'My Transactions')

@section('transactions-li', 'selected')
@section('transactions', 'active')

@section('content')

    @include('user.sidebar')
    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i> My Transactions</div>
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

                            <div class="nav-tabs-boxed">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home">Deposit</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile">Withdrawal</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <table class="table table-bordered table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($deposits as $deposit)
                                                    <tr>
                                                        <th scope="row">{{ $deposit->id }}</th>
                                                        <td>{{ \App\Models\Setting::getValue('currency') }}{{ $deposit->amount }}
                                                        </td>
                                                        <td>{{ $deposit->payment_mode }}</td>
                                                        <td>{{ $deposit->status }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">No data available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <table class="table table-bordered table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($withdrawals as $withdrawal)
                                                    <tr>
                                                        <th scope="row">{{ $withdrawal->id }}</th>
                                                        <td>{{ \App\Models\Setting::getValue('currency') }}{{ $withdrawal->amount }}
                                                        </td>
                                                        <td>{{ $withdrawal->to_deduct }}</td>
                                                        <td>{{ $withdrawal->payment_mode }}</td>
                                                        <td>{{ $withdrawal->status }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($withdrawal->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">No data available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
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
