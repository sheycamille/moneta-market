@extends('layouts.app')

@section('title', 'My Notifications')

@section('my-account', 'c-show')
@section('notifications', 'c-active')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            @lang('message.body.notif')
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

                            <div class="row mb-5">
                                <div class="col">
                                    <div class="bs-example table-responsive" data-example-id="hoverable-table">
                                        <table class="table table-bordered table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>@lang('message.body.msg')</th>
                                                    <th>@lang('message.body.rcd_date')</th>
                                                    <th>@lang('message.body.act')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($Notif as $notification)
                                                    <tr>
                                                        <td> <a href="#" data-toggle="modal"
                                                                data-target="#message{{ $notification->id }}"
                                                                class=" ">
                                                                {{ substr($notification->message, 0, 85) }}
                                                            </a> </td>
                                                        <td> {{ \Carbon\Carbon::parse($notification->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                        <td> <a href="{{ route('delnotif') }}/{{ $notification->id }}"
                                                                type="button" data-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>

                                                    <div id="message{{ $notification->id }}" class="modal fade"
                                                        role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content -->
                                                            <div class="modal-content">
                                                                <div class="modal-header .modal-dialog-centered">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="font-italic">
                                                                        <p class="">{{ $notification->message }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">@lang('message.body.no_data')</td>
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
