@extends('layouts.app')

@section('title', 'Manage Users')

@section('musers-li', 'selected')
@section('musers', 'active')

@section('css')
    <style>
        .tb-actions {
            width: 20%;
        }
    </style>
@endsection

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        {{ \App\Models\Setting::getValue('site_name') }} Users
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

                        <div class="row">
                            <div class="col">
                                <a href="{{ route('fetchmobiususers') }}" class="btn btn-success btn-md mb-2">Fetch Mobius
                                    Users</a>

                                @if (auth('admin')->user()->hasPermissionTo('muser-messageall', 'admin'))
                                    <a href="#" data-toggle="modal" data-target="#sendmailModal"
                                        class="btn btn-primary btn-md mb-2">Message all</a>
                                @endif

                                @if (\App\Models\Setting::getValue('enable_kyc') == 'yes' &&
                                    auth('admin')->user()->hasPermissionTo('mkyc-list', 'admin'))
                                    <a href="{{ route('kyc') }}" class="btn btn-warning btn-md mb-2">KYC</a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                                <table id="ShipTable"
                                    class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Client Name</th>
                                            <th>Phone/Email</th>
                                            <th>Balance</th>
                                            <th>Bonus</th>
                                            <th>No. of Accounts</th>
                                            <th>Status</th>
                                            <th>Date Registered</th>
                                            <th class="tb-actions">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                                <td>{{ $user->phone }} | {{ $user->email }}</td>
                                                <td>{{ $user->totalBalance() }}</td>
                                                <td>{{ $user->totalBonus() }}</td>
                                                @php $numAccs = count($user->accounts()) @endphp
                                                <td>{{ $numAccs }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td>{{ $user->created_at }}
                                                </td>
                                                <td class="tb-actions">
                                                    <div id="actions{{ $user->id }}"><a href="#"
                                                            onclick="loadActions({{ $user->id }})"
                                                            class="m-1 btn btn-primary btn-xs">Actions</a></div>
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

@endsection

@section('javascript')
    <script src="{{ asset('admin/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                order: [
                    [7, 'desc']
                ],
                'pageLength': 100,
            });
        });

        function loadActions(id) {
            $.get('users/getactions/' + id, function(data) {
                $('#actions' + id).html(data);
            });
        }
    </script>
@endsection
