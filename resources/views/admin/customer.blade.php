@extends('layouts.app')

@section('title', 'Manager New Users')

@section('content')

@include('admin.topmenu')
@include('admin.sidebar')

<div class="container-fluid">
    <div class="fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header fw-bolder">
                    <h1 class="title1 text-center">
                        Follow up members
                    </h1>
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
                                <button type="button" clsass="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                @foreach ($errors->all() as $error)
                                <i class="fa fa-warning"></i> {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-5">
                        <div class="col-lg-12 p-4">
                            <div class="table-responsive" data-example-id="hoverable-table">
                                <table id="ShipTable" class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Balance</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Date registered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $list)
                                        <tr>
                                            <th scope="row">{{ $list->id }}</th>
                                            <td>${{ $list->account_bal }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->l_name }}</td>
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->phone_number }}</td>
                                            <td>{{ $list->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($list->created_at)->toDayDateTimeString() }}
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm m-1" data-toggle="modal"
                                                    data-target="#editModal{{ $list->id }}">Edit Status</a>
                                            </td>
                                        </tr>

                                        <div id="editModal{{ $list->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div
                                                        class="modal-header bg-{{ Auth('admin')->User()->dashboard_style }}">
                                                        <h4 class="modal-title">Edit this User status</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div
                                                        class="modal-body bg-{{ Auth('admin')->User()->dashboard_style }}">
                                                        <form method="post" action="{{ route('updateuser') }}">
                                                            <div class="form-group">
                                                                <h5 class="">User Status</h5>
                                                                <textarea name="userupdate" id="" rows="5"
                                                                    class="form-control" placeholder="Enter here"
                                                                    required>{{ $list->userupdate }}</textarea>
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $list->id }}">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-primary" value="Save">

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /send all users email Modal -->
                                        @empty
                                        <tr>
                                            <td colspan="9">No data available</td>
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
                    [8, 'desc']
                ],
            });
        });
    </script>
@endsection

