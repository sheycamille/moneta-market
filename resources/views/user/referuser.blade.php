@extends('layouts.app')

@section('title', 'My Referrals')

@section('profile-li', 'selected')
@section('referrals', 'active')

@section('content')

    @include('user.sidebar')
    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            Refer users to {{ \App\Models\Setting::getValue('site_name') }} community
                        </div>
                        <div class="card-body">

                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
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

                            <div class="row">
                                <div class="col-12 text-center card shadow-lg p-3">
                                    <strong>You can refer users by sharing your referral link:</strong><br>
                                    <h4 style="color:green;">
                                        {{ Auth::user()->ref_link ? Auth::user()->ref_link : 'https://portal.monetamarket.ca/ref/' . Auth::user()->id }}
                                    </h4> <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col card p-3 shadow-lg ">
                                    <h2 class="title1">{{ $title }}</h2>
                                    <div class="bs-example widget-shadow table-responsive"
                                        data-example-id="hoverable-table">
                                        <table class="table UserTable table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client name</th>
                                                    <th>FTD(Y/N)</th>
                                                    <th>Client Status</th>
                                                    <th>Date registered</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($team as $member)
                                                    <tr>
                                                        <th scope="row">{{ $member->id }}</th>
                                                        <td>{{ $member->name }}</td>
                                                        <td>{{ $member->ftd() ? 'Yes' : 'No' }} </td>
                                                        <td>{{ $member->status }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($member->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">@lang('message.body.no_data')</td>
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
@endsection
