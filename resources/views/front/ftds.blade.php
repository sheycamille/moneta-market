@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header fw-bolder">
                            {{ $title }}
                        </div>
                        <div class="card-body">

                            <div class="mb-5 row">
                                <div class="col shadow card p-4 bg-{{ Auth('admin')->User()->dashboard_style }}">
                                    <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">

                                        <table id="ShipTable" class="table table-hover text-primary">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Client Name</th>
                                                    <th>Date of Registration </th>
                                                    <th>First Deposit</th>
                                                    <th>Date of Deposit </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    @php
                                                        $dp = $user
                                                            ->dp()
                                                            ->where('status', 'Processed')
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $user->id }}</th>

                                                        <td>
                                                            @if ($user->name)
                                                                {{ $user->name }}
                                                            @else
                                                                {{ $user->first_name . ' ' . $user->last_name }}
                                                            @endif
                                                        </td>
                                                        <td> {{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}
                                                        </td>
                                                        <td>{{ $dp->amount }}</td>
                                                        <td>
                                                            @if ($dp->amount > 0)
                                                                {{ \Carbon\Carbon::parse($dp->date_created)->toDayDateTimeString() }}
                                                            @endif
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
@endsection
