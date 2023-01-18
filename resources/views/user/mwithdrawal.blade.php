@extends('layouts.app')

@section('title', 'Request a Withdrawal')

@section('dw-li', 'selected')
@section('withdrawals', 'active')

@section('content')

    @include('user.sidebar')
    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            Request for Withdrawal
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

                            <div class="mb-5 row">
                                @foreach ($wmethods as $method)
                                    <div class="col-lg-4 p-3 rounded card">
                                        <div class="shadow card-body border-danger">
                                            <img height="100px" width="100px"
                                                    style="margin-left: auto; margin-right:auto; padding-top:5px;"
                                                    src="{{ asset('storage/photos/logos/' . $method->logo) }}"
                                                    alt="{{ $method->logo }}">
                                            <h2 class="card-title mb-3">{{ $method->name }}</h2>
                                            <h4 class="">Minimum amount: <strong style="float:right;">
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $method->minimum }}</strong>
                                            </h4>
                                            <br>

                                            <h4 class="">Maximum amount:<strong style="float:right;">
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $method->maximum }}</strong>
                                            </h4><br>

                                            <h4 class="">Charges (Fixed):<strong style="float:right;">
                                                    {{ \App\Models\Setting::getValue('currency') }}{{ $method->charges_fixed }}</strong>
                                            </h4><br>

                                            <h4 class="">Charges (%): <strong style="float:right;">
                                                    {{ $method->charges_percentage }}%</strong></h4><br>

                                            <h4 class="">Duration:<strong style="float:right;">
                                                    {{ $method->duration }}</strong></h4><br>
                                            <div class="text-center">
                                                @if (\App\Models\Setting::getValue('enable_with') == 'true')
                                                    <a class="btn btn-primary" href="#" data-toggle="modal"
                                                        data-target="#withdrawdisabled"><i class="fa fa-plus"></i> Request
                                                        withdrawal</a>
                                                @else
                                                    <a class="btn btn-primary" href="#" data-toggle="modal"
                                                        data-target="#withdrawalModal{{ $method->id }}"><i
                                                            class="fa fa-plus"></i>
                                                        Request withdrawal</a>
                                                @endif

                                            </div>

                                        </div>
                                    </div>

                                    <!-- Withdrawal Modal -->
                                    <div id="withdrawalModal{{ $method->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Payment will be sent through your selected
                                                        method.
                                                    </h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form style="padding:3px;" role="form" method="post"
                                                        action="{{ route('withdrawal') }}" validate>
                                                        <input class="form-control" placeholder="Enter amount here"
                                                            type="text" name="amount" required value=""><br />
                                                        <input class="form-control " value="{{ $method->name }}"
                                                            type="text" disabled><br />
                                                        <select class="form-control" name="account_id" id="account_id"
                                                            required>
                                                            <option value="">Choose Account</option>
                                                            @foreach (Auth::user()->accounts() as $account)
                                                                <option value="{{ $account->id }}">{{ $account->number }}
                                                                    | USD {{ $account->balance }} </option>
                                                            @endforeach
                                                        </select> <br>
                                                        <input value="{{ $method->name }}" type="hidden"
                                                            name="payment_mode">
                                                        <input value="{{ $method->id }}" type="hidden"
                                                            name="method_id"><br />

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Withdrawal Modal -->
                                @endforeach
                            </div>

                            <!-- Withdrawal Disabled Modal -->
                            <div id="withdrawdisabled" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Withdrawal Status</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="">Withdrawal is disabled at this time, Please contact
                                                support for assistance.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Withdrawals Disabled Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
