@extends('layouts.app')

@section('title', 'My Transaction History')

@section('content')

    @include('user.topmenu')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            @lang('message.body.his')
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
                                <div class="col text-center card shadow-lg p-3">
                                    <div class="bs-example widget-shadow table-responsive"
                                        data-example-id="hoverable-table">
                                        <table id="UserTable" class="UserTable table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>@lang('message.body.pur')</th>
                                                    <th>@lang('message.body.amount')</th>
                                                    <th>@lang('message.body.typ')</th>
                                                    <th>@lang('message.body.date_created')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($t_history as $history)
                                                    <tr>
                                                        <th scope="row">{{ $history->id }}</th>
                                                        <td>{{ $history->purpose }}</td>
                                                        <td>{{ \App\Models\Setting::getValue('currency') }}{{ $history->amount }}
                                                        </td>
                                                        <td>{{ $history->type }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($history->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                    </tr>
                                                @endforeach
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
