@extends('layouts.app')

@section('title', 'Manage Account Types')

@section('maccounts', 'c-show')
@section('accounttypes', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        <h1 class="title1 text-center">
                            {{ $title }}
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
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        @foreach ($errors->all() as $error)
                                            <i class="fa fa-warning"></i> {{ $error }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-5 row">
                            <div class="col-12 p-4">
                                <div class="col-2 p-0 pb-4">
                                    <a class="btn btn-primary" href="{{ route('showaddaccounttype') }}">
                                        <i class="fa fa-plus"></i>
                                        New Account Type
                                    </a>
                                </div>

                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable"
                                        class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Forex Pairs</th>
                                                <th>Commodities</th>
                                                <th>Indices</th>
                                                <th>Cost</th>
                                                <th>Status</th>
                                                <th>Date created</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($accounttypes as $accounttype)
                                                <tr>
                                                    <th scope="row">{{ $accounttype->id }}</th>
                                                    <td>{{ $accounttype->name }}</td>
                                                    <td>{{ $accounttype->num_fx_pairs }}</td>
                                                    <td>{{ $accounttype->num_commodities_pairs }}</td>
                                                    <td>{{ $accounttype->num_indices_pairs }}</td>
                                                    <td>{{ \App\Models\Setting::getValue('currency') }}{{ $accounttype->amount }}
                                                    </td>
                                                    <td>
                                                        @if ($accounttype->active)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>{{ $accounttype->created_at }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#popModal{{ $accounttype->id }}"
                                                            class="m-1 btn btn-warning btn-sm">Edit</a>
                                                        <a href="{{ route('delaccounttype', $accounttype->id) }}"
                                                            class="m-1 btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>

                                                <!-- POP Modal -->
                                                <div id="popModal{{ $accounttype->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">
                                                                    {{ $accounttype->name }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4></h4>

                                                                <form
                                                                    action="{{ route('updateaccounttype', $accounttype->id) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <h5 class="">Name</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter maximum price" type="text"
                                                                        name="name" value="{{ $accounttype->name }}"
                                                                        required>
                                                                    <br />

                                                                    <h5 class="">Cost</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter cost" type="text"
                                                                        name="cost" value="{{ $accounttype->cost }}"
                                                                        required>
                                                                    <br />

                                                                    <h5 class="">Minimum deposit</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter Minimum deposit" type="text"
                                                                        name="min_deposit"
                                                                        value="{{ $accounttype->min_deposit }}" required>
                                                                    <br />

                                                                    <h5 class="">Max Leverage</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter Max Leverage" type="text"
                                                                        name="max_leverage"
                                                                        value="{{ $accounttype->max_leverage }}" required>
                                                                    <br />

                                                                    <h5 class="">Minimum Trade Size</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter min trade size" type="text"
                                                                        name="min_trade_size"
                                                                        value="{{ $accounttype->min_trade_size }}"
                                                                        required>
                                                                    <br />

                                                                    <h5 class="">Maximum Trade Size</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter max trade size" type="text"
                                                                        name="max_trade_size"
                                                                        value="{{ $accounttype->max_trade_size }}"
                                                                        required>
                                                                    <br />

                                                                    <h5 class="">Swaps</h5>
                                                                    <select name="swaps">
                                                                        <option selected disabled>Choose Availability
                                                                        </option>
                                                                        <option
                                                                            @if (old('swaps') == 1) selected @endif
                                                                            value="1">
                                                                            Yes
                                                                        </option>
                                                                        <option
                                                                            @if (old('swaps') == 0) selected @endif
                                                                            value="0">
                                                                            No
                                                                        </option>
                                                                    </select>
                                                                    <br />

                                                                    <h5 class="">Forex Commissions</h5>
                                                                    <input style="padding:5px;" class="form-control"
                                                                        placeholder="Enter forex commision" type="text"
                                                                        name="fx_commission"
                                                                        value="{{ $accounttype->fx_commission }}"
                                                                        required>
                                                                    <br />

                                                                    <h5 class="">Number of Forex Pairs/h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter forex pairs" type="text"
                                                                            name="num_fx_pairs"
                                                                            value="{{ $accounttype->num_fx_pairs }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Number of Commodities
                                                                            Pairs</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter commodities pairs"
                                                                            type="text" name="num_commodities_pairs"
                                                                            value="{{ $accounttype->num_commodities_pairs }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Number of Indices
                                                                            Pairs
                                                                        </h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter indices pairs"
                                                                            type="text" name="num_indices_pairs"
                                                                            value="{{ $accounttype->num_indices_pairs }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Trading Platforms</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter trading platforms"
                                                                            type="text" name="trading_platforms"
                                                                            value="{{ $accounttype->trading_platforms }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Trading Model</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter trading model"
                                                                            type="text" name="trading_model"
                                                                            value="{{ $accounttype->trading_model }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Execution Type</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter Execution Type"
                                                                            type="text" name="execution_type"
                                                                            value="{{ $accounttype->execution_type }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Typical Spread</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter Typical Spread"
                                                                            type="text" name="typical_spread"
                                                                            value="{{ $accounttype->typical_spread }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Requotes</h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter Requotes" type="text"
                                                                            name="requotes"
                                                                            value="{{ $accounttype->requotes }}" required>
                                                                        <br />

                                                                        <h5 class="">Available Instruments
                                                                        </h5>
                                                                        <input style="padding:5px;" class="form-control"
                                                                            placeholder="Enter Available Instruments"
                                                                            type="text" name="available_instruments"
                                                                            value="{{ $accounttype->available_instruments }}"
                                                                            required>
                                                                        <br />

                                                                        <h5 class="">Educational Material
                                                                        </h5>
                                                                        <select name="educational_material">
                                                                            <option selected disabled>Choose Availability
                                                                            </option>
                                                                            <option
                                                                                @if ($accounttype->educational_material == 1) selected @endif
                                                                                value="1">Yes
                                                                            </option>
                                                                            <option
                                                                                @if ($accounttype->educational_material == 0) selected @endif
                                                                                value="0">No
                                                                            </option>
                                                                        </select>
                                                                        <br />
                                                                        <br>

                                                                        <h5 class="">Active/Disable
                                                                        </h5>
                                                                        <select name="active">
                                                                            <option selected disabled>Choose Availability
                                                                            </option>
                                                                            <option
                                                                                @if ($accounttype->active == 1) selected @endif
                                                                                value="1">Yes
                                                                            </option>
                                                                            <option
                                                                                @if ($accounttype->active == 0) selected @endif
                                                                                value="0">No
                                                                            </option>
                                                                        </select>
                                                                        <br />
                                                                        <br>

                                                                        <div class="form-group">
                                                                            <div>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary btn-lg px-3">
                                                                                    <i class="fa fa-plus"></i> Save
                                                                                    {{ $accounttype->name }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /POP Modal -->
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
                    [7, 'desc']
                ],
                'pageLength': 100,
            });
        });
    </script>
@endsection
