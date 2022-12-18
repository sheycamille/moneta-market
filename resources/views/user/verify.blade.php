@extends('layouts.app')

@section('title', 'Account Verification(KYC)')

@section('my-account', 'c-show')
@section('kyc', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-left">@lang('message.verify.veri')</h1>
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


                            @if (\App\Models\Setting::getValue('enable_kyc') == 'yes')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-5 row">
                                            <div class="col-lg-8 offset-lg-2 card p-4 shadow-lg">
                                                <h1 class="nav-link" data-toggle="dropdown" href="#"
                                                    aria-expanded="false">
                                                    KYC
                                                </h1>
                                                <div class="quick-actions-header">
                                                    @if (Auth::user()->account_verify == '')
                                                        <h4 class="ml-3">
                                                            <a href="#" class="p-0 col-12"><i
                                                                    class="glyphicon glyphicon-ok"></i>
                                                                @lang('message.verify.status')</a>
                                                        </h4>
                                                    @else
                                                        <h4 class="ml-3">
                                                            <a> KYC Status: {{ Auth::user()->account_verify }}</a>
                                                        </h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-12">
                                    <h3 class="text-left">
                                        @lang('message.verify.kyc_veri')
                                    </h3>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" clsass="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            @foreach ($errors->all() as $error)
                                                <i class="fa fa-warning"></i> {{ $error }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (\App\Models\Setting::getValue('enable_kyc') == 'yes' && Auth::user()->account_verify != 'Verified')
                                <div class="mb-5 row">

                                    <div class="col-lg-8 offset-lg-2 card p-4 shadow-lg">
                                        <div class="py-3">
                                            <h3 class="">@lang('message.verify.upload').
                                            </h3>
                                        </div>
                                        <form role="form" method="post" action="{{ route('kycsubmit') }}"
                                            enctype="multipart/form-data">
                                            <h5 class="">@lang('message.verify.identity').</h5>
                                            <input type="file" class="form-control" name="idcard"
                                                @if (!Auth::user()->id_card) required @endif
                                                value="{{ asset('storage/photos/' . Auth::user()->id_card) }}">
                                            @if (Auth::user()->id_card)
                                                <img src="{{ asset('storage/photos/' . Auth::user()->id_card) }}"
                                                    width="100">
                                            @endif
                                            <br><br>

                                            <h5 class="">@lang('message.verify.bak')</h5>
                                            <input type="file" class="form-control" name="idcard_back"
                                                @if (!Auth::user()->id_card_back) required @endif
                                                value="{{ asset('storage/photos/' . Auth::user()->id_card_back) }}">
                                            @if (Auth::user()->id_card_back)
                                                <img src="{{ asset('storage/photos/' . Auth::user()->id_card_back) }}"
                                                    width="100">
                                            @endif
                                            <br><br>

                                            <h5 class="">@lang('message.verify.doc')</h5>
                                            <input type="file" class="form-control" name="address_document"
                                                @if (!Auth::user()->address_document) required @endif
                                                value="{{ asset('storage/photos/' . Auth::user()->address_document) }}">
                                            @if (Auth::user()->address_document)
                                                <img src="{{ asset('storage/photos/' . Auth::user()->address_document) }}"
                                                    width="100">
                                            @endif
                                            <br><br>

                                            <h5 class="">@lang('message.verify.selfie')</h5>
                                            <input type="file" class="form-control" name="passport"
                                                @if (!Auth::user()->passport) required @endif
                                                value="{{ asset('storage/photos/' . Auth::user()->passport) }}">
                                            @if (Auth::user()->passport)
                                                <img src="{{ asset('storage/photos/' . Auth::user()->passport) }}"
                                                    width="100">
                                            @endif
                                            <br><br>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-primary" value="Submit documents">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
