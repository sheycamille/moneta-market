@extends('layouts.app')

@section('title', 'Manage admins')

@section('manage-admins', 'c-show')
@section('roles', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        Roles
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
                        @if (auth('admin')->user()->hasPermissionTo('mrole-create', 'admin'))
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('createrole') }}" class="btn btn-primary btn-sm mb-2">Create New
                                        Role</a>
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
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>PERMISSION</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $key => $role)
                                                <tr>
                                                    <td>{{ $role->id }}</td>
                                                    <td>{{ $role->name }} </td>
                                                    <td>
                                                        @foreach ($role->permissions as $perm)
                                                            <label class="text-muted">{{ $perm->name }}</label>,
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            @if (auth('admin')->user()->hasPermissionTo('mrole-edit', 'admin'))
                                                                <a href="{{ route('editrole', $role->id) }}"
                                                                    class="m-1 btn btn-secondary btn-sm">Edit</a>
                                                            @endif
                                                            @if (auth('admin')->user()->hasPermissionTo('mrole-delete', 'admin'))
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#deleteModal{{ $role->id }}"
                                                                    class="m-1 btn btn-danger btn-sm">Delete</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Delete role Modal -->
                                                <div id="deleteModal{{ $role->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h4 class="modal-title ">Delete Role</strong></h4>
                                                                <button type="button" class="close "
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body p-3">
                                                                <form action="{{ route('deleterole', $role->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <p class="">Are you sure you want to delete
                                                                        {{ $role->name }}?</p>
                                                                    <button class="btn btn-danger btn-sm">Yes, I'm
                                                                        sure</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Delete role Modal -->
                                            @empty
                                                <tr>
                                                    <td colspan="4">No data available</td>
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

@endsection
@section('javascript')
    <script src="{{ asset('admin/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                order: [
                    [2, 'asc']
                ],
            });
        });
    </script>
@endsection
