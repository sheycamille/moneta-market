@extends('layouts.app')

@section('title', 'Manage admins')

@section('manage-admins', 'c-show')
@section('perms', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        Permissions
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
                            <div class="col">
                                <a class="btn btn-primary btn-md mb-2" href="#" data-toggle="modal"
                                    data-target="#createpermissionmodal">Create New Permission</a>
                            </div>
                        </div>

                        <div class="mb-5 row">
                            <div class="col p-4">
                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable"
                                        class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>PERMISSIONS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($permissions as $perm)
                                                <tr>
                                                    <td>{{ $perm->id }}</td>
                                                    <td>{{ $perm->name }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            <!--<a href="{{ route('editrole', $perm->id) }}" class="m-1 btn btn-secondary btn-sm">Edit</a>-->
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#deleteModal{{ $perm->id }}"
                                                                class="m-1 btn btn-danger btn-sm">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Delete permission Modal -->
                                                <div id="deleteModal{{ $perm->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                                <h4 class="modal-title ">Delete Permission</strong></h4>
                                                                <button type="button" class="close "
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body p-3">
                                                                <form action="{{ route('deleteperm', $perm->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <p class="">Are you sure you want to delete
                                                                        permission
                                                                        {{ $perm->name }}?</p>
                                                                    <button class="btn btn-danger btn-sm">Yes, I'm
                                                                        sure</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Delete permission Modal -->
                                            @empty
                                                <tr>
                                                    <td colspan="4">No data available</td>
                                                </tr>
                                            @endforelse

                                            <!-- Create permission Modal -->
                                            <div id="createpermissionmodal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">

                                                            <h4 class="modal-title ">Add New Permission</strong></h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body p-3">
                                                            <form style="" role="form" method="post"
                                                                action="{{ route('storeperm') }}">
                                                                @csrf
                                                                <h5 class=" ">Permission Name</h5>
                                                                <input style="" class="form-control " type="text"
                                                                    name="name">
                                                                <br>
                                                                <button class="btn btn-primary btn-sm">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Create permission Modal -->
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
