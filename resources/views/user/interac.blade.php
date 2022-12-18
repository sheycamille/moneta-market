@extends('layouts.app')

@section('title', 'Interac Payment')

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
                                        <h3 class="">You are sending
                                            <strong>{{ \App\Models\Setting::getValue('currency') }}{{ $amount }}
                                                USD</strong> to
                                            the Interac details below
                                        </h3>
                                    </div>
                                    <div class="row justify-content-center m-3">
                                        <div class="col-lg-4">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h3>
                                                        <a style="text-decoration:none;" class="collapsed"
                                                            data-toggle="collapse" data-parent="#accordion" href="#interac">
                                                            <strong>Interac Details </strong>
                                                        </a>
                                                    </h3>
                                                    <div id="interac" class="panel-collapse">
                                                        <div class="">
                                                            @if (\App\Models\Setting::getValue('interac_name'))
                                                                <h4 class=""><strong>Name:</strong>
                                                                    {{ \App\Models\Setting::getValue('interac_name') }}
                                                                </h4>
                                                            @endif
                                                            @if (\App\Models\Setting::getValue('interac_email'))
                                                                <h4 class=""><strong>Email:</strong>
                                                                    {{ \App\Models\Setting::getValue('interac_email') }}
                                                                </h4>
                                                            @endif
                                                            @if (\App\Models\Setting::getValue('interac_phone'))
                                                                <h4 class=""><strong>Phone
                                                                        Number:</strong>
                                                                    {{ \App\Models\Setting::getValue('interac_phone') }}
                                                                </h4>
                                                            @endif
                                                            <h4 class=""><strong>Message:</strong>
                                                                {{ \App\Models\Setting::getValue('interac_message') }}
                                                            </h4>
                                                            <h4 class=""><strong>Question:</strong>
                                                                {{ \App\Models\Setting::getValue('interac_question') }}
                                                            </h4>
                                                            <h4 class=""><strong>Answer:</strong>
                                                                {{ \App\Models\Setting::getValue('interac_answer') }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form class="col-md-4" method="post" action="{{ route('savedeposit') }}"
                                            enctype="multipart/form-data">
                                            <h3 class="">Upload proof of payment.</h3>
                                            <input type="file" name="proof" class="form-control" required>
                                            <br>

                                            <h5 class="">Payment Mode Used:</h5>
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
