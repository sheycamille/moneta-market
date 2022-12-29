@extends('layouts.app')

@section('title', 'Manage Withdrawals')

@section('manage-dw', 'c-show')
@section('withdrawals', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        Client Withdrawals
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
                            <div class="col p-3">
                                <div class="bs-example table-responsive" data-example-id="hoverable-table">
                                    <div style="margin:3px;">
                                        <table id="ShipTable"
                                            class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Client name</th>
                                                    <th>Amount requested</th>
                                                    <th>Amount + charges</th>
                                                    <th>Trader7 Account</th>
                                                    <th>Payment mode</th>
                                                    <th>Receiver's email</th>
                                                    <th>Status</th>
                                                    <th>Date created</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($withdrawals as $withdrawal)
                                                    <tr>
                                                        <th scope="row">{{ $withdrawal->id }}</th>
                                                        <td>{{ $withdrawal->duser->name ? $withdrawal->duser->name : $withdrawal->duser->first_name . ' ' . $withdrawal->duser->last_name }}
                                                        </td>
                                                        <td>{{ $withdrawal->amount }}</td>
                                                        <td>{{ $withdrawal->to_deduct }}</td>
                                                        <td>{{ $withdrawal->t7->number }}</td>
                                                        <td>{{ $withdrawal->payment_mode }}</td>
                                                        <td>{{ $withdrawal->duser->email }}</td>
                                                        <td>{{ $withdrawal->status }}</td>
                                                        <td>{{ $withdrawal->created_at }}
                                                        </td>
                                                        <td>
                                                            <a href="#" class="m-1 btn btn-info btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#viewModal{{ $withdrawal->id }}"><i
                                                                    class="fa fa-eye"></i>
                                                                View</a>
                                                            @if ($withdrawal->status == 'Processed' || $withdrawal->status == 'Rejected')
                                                                <a class="@if ($withdrawal->status == 'Processed') btn-success @else btn-danger @endif btn-sm"
                                                                    href="#">{{ $withdrawal->status }}</a>
                                                            @else
                                                                @if (auth('admin')->user()->hasPermissionTo('mwithdrawal-process', 'admin'))
                                                                    <a class="m-1 btn btn-primary btn-sm"
                                                                        href="{{ route('pwithdrawal', $withdrawal->id) }}">Process</a>
                                                                @endif
                                                                @if (auth('admin')->user()->hasPermissionTo('mwithdrawal-process', 'admin'))
                                                                    <a class="m-1 btn btn-primary btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#rejctModal{{ $withdrawal->id }}"
                                                                        href="#">Reject</a>
                                                                @endif
                                                            @endif

                                                        </td>
                                                    </tr>

                                                    <!-- Reject modal-->
                                                    <div id="rejctModal{{ $withdrawal->id }}" class="modal fade"
                                                        role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header ">
                                                                    <h4 class="modal-title">Reason For
                                                                        Rejection.</strong></h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('rejectwithdrawal') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <textarea class="mb-2 form-control" row="3" placeholder="Type in here" name="reason"></textarea>
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $withdrawal->id }}">
                                                                        <input type="submit" class="btn btn-warning"
                                                                            value="Done">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Reject modal-->

                                                    <!-- View info modal-->
                                                    <div id="viewModal{{ $withdrawal->id }}" class="modal fade"
                                                        role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header ">
                                                                    <h4 class="modal-title">
                                                                        {{ $withdrawal->duser->name }} Withdrawal
                                                                        Details</strong>
                                                                    </h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if ($withdrawal->payment_mode == 'Bitcoin')
                                                                        <h3 class="">BTC Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->btc_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'Ethereum')
                                                                        <h3 class="">ETH Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->eth_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'Litecoin')
                                                                        <h3 class="">LTC Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->ltc_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'USDT')
                                                                        <h3 class="">USDT Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->usdt_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'USDC')
                                                                        <h3 class="">USDC Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->usdc_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'XRP')
                                                                        <h3 class="">XRP Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->xrp_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'BNB')
                                                                        <h3 class="">BNB Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->bnb_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'Bitcoin Cash')
                                                                        <h3 class="">BCH Wallet:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->usdt_address }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'Interac')
                                                                        <h3 class="">Interac Email:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->interac }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'PayPal')
                                                                        <h3 class="">PayPal Email:</h3>
                                                                        <h4 class="">
                                                                            {{ $withdrawal->duser->paypal_email }}</h4><br>
                                                                    @elseif($withdrawal->payment_mode == 'Bank transfer')
                                                                        <h4 class="">Bank name:
                                                                            {{ $withdrawal->duser->bank_name }}</h4><br>
                                                                        <h4 class="">Bank Address:
                                                                            {{ $withdrawal->duser->bank_address }}</h4><br>
                                                                        <h4 class="">Swift Code:
                                                                            {{ $withdrawal->duser->swift_code }}</h4><br>
                                                                        <h4 class="">Account name:
                                                                            {{ $withdrawal->duser->account_name }}</h4><br>
                                                                        <h4 class="">Account number:
                                                                            {{ $withdrawal->duser->account_number }}</h4>
                                                                    @else
                                                                        <h4 class="">Get in touch with
                                                                            client. <br><br>{{ $withdrawal->duser->email }}
                                                                        </h4>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <tr>
                                                        <td colspan="10">No data available</td>
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

    @include('admin.includes.modals')
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
                'pageLength': 100,
            });
        });
    </script>
@endsection
