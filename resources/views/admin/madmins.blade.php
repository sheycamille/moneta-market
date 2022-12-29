@extends('layouts.app')

@section('title', 'Manage admins')

@section('manage-admins', 'c-show')
@section('admins', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        Managers
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

                        @if (auth('admin')->user()->hasPermissionTo('madmin-create', 'admin'))
                            <div class="row">
                                <div class="col p-4">
                                    <a href="{{ route('addadmin') }}" class="btn btn-primary btn-md mb-2">Add
                                        Admin</a>
                                </div>
                            </div>
                        @endif

                        <div class="mb-5 row">
                            <div class="col p-4">
                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable"
                                        class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>USER ID</th>
                                                <th>FIRSTNAME</th>
                                                <th>LASTNAME</th>
                                                <th>EMAIL</th>
                                                <th>PHONE</th>
                                                <th>TYPE</th>
                                                <th>STATUS</th>
                                                <th>ROLE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
@endsection

@section('javascript')
    <script src="{{ asset('admin/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('fetchadmin') }}",
                columns: [{
                        data: 'id',
                        name: 'ID'
                    },
                    {
                        data: 'firstName',
                        name: 'Firstname'
                    },
                    {
                        data: 'lastName',
                        name: 'Lastname'
                    },
                    {
                        data: 'email',
                        name: 'Email'
                    },
                    {
                        data: 'phone',
                        name: 'Phome'
                    },
                    {
                        data: 'type',
                        name: 'Type'
                    },
                    {
                        data: 'status',
                        name: 'Status'
                    },
                    {
                        data: 'role',
                        name: 'Role'
                    },
                    {
                        data: 'action',
                        name: 'Action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endsection
