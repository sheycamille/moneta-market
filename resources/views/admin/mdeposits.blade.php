@extends('layouts.app')

@section('title', 'Manage Deposits')

@section('manage-dw', 'c-show')
@section('deposits', 'c-active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        Client Deposits
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
                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable"
                                        class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Client name</th>
                                                <th>Client email</th>
                                                <th>Trader7 Account</th>
                                                <th>Amount</th>
                                                <th>Payment mode</th>
                                                <th>Status</th>
                                                <th>Date created</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($deposits as $deposit)
                                                <tr>
                                                    <th scope="row">{{ $deposit->id }}</th>
                                                    <td>{{ $deposit->duser->name ? $deposit->duser->name : $deposit->duser->first_name . ' ' . $deposit->duser->last_name }}
                                                    </td>
                                                    <td>{{ $deposit->duser->email }}</td>
                                                    <td>
                                                        @if ($deposit->t7)
                                                            {{ $deposit->t7->number }}
                                                        @endif
                                                    </td>
                                                    <td>{{ \App\Models\Setting::getValue('currency') }}{{ $deposit->amount }}
                                                    </td>
                                                    <td>{{ $deposit->payment_mode }}</td>
                                                    <td>{{ $deposit->status }}</td>
                                                    <td>{{ $deposit->created_at }}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm m-1"
                                                            data-toggle="modal" data-target="#popModal{{ $deposit->id }}"
                                                            title="View payment proof">
                                                            Proof
                                                        </a>

                                                        <a href="#" class="btn btn-primary btn-sm m-1"
                                                            data-toggle="modal"
                                                            data-target="#sendMessageModal{{ $deposit->id }}"
                                                            title="Send Message">
                                                            Message
                                                        </a>

                                                        @if ($deposit->status == 'Processed' || $deposit->status == 'Rejected')
                                                            <a class="btn btn-sm @if ($deposit->status == 'Processed') btn-success @else btn-danger @endif btn-xs"
                                                                href="#">{{ $deposit->status }}</a>
                                                        @else
                                                            @if (auth('admin')->user()->hasPermissionTo('mdeposit-process', 'admin'))
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('pdeposit', $deposit->id) }}">Process</a>
                                                            @endif
                                                            <a class="m-1 btn btn-primary btn-sm" data-toggle="modal"
                                                                data-target="#rejctModal{{ $deposit->id }}"
                                                                href="#">Reject</a>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- View info modal-->
                                                <div id="rejctModal{{ $deposit->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-heade ">
                                                                <h4 class="modal-title">Reason For
                                                                    Rejection.</strong></h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('rejectdeposit', $deposit->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <textarea class="bg-{{ Auth('admin')->User()->dashboard_style }} mb-2 form-control" row="3"
                                                                        placeholder="Type in here" name="reason"></textarea>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $deposit->id }}">
                                                                    <input type="submit" class="btn btn-warning"
                                                                        value="Done">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End View info modal-->

                                                <!-- POP Modal -->
                                                <div id="popModal{{ $deposit->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">
                                                                    {{ $deposit->duser->name }} proof of payment</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($deposit->payment_mode == 'Credit Card' ||
                                                                    $deposit->payment_mode == 'Express Deposit' ||
                                                                    $deposit->payment_mode == 'CoinPayments')
                                                                    <h4>This Payment was either
                                                                        made with credit/debit card, admin topup or
                                                                        automatic crypto
                                                                        payment hence no proof of payment provided</h4>
                                                                @else
                                                                    @if (\App\Models\Setting::getValue('location') == 'Email')
                                                                        <h3
                                                                            class=">
                                                                        Check your email with
                                                                        the deposit that has an attachment name of
                                                                        <span
                                                                            class="text-danger">
                                                                            {{ $deposit->proof }}</span>
                                                                        </h3>
                                                                    @elseif(\App\Models\Setting::getValue('location') == 'Local')
                                                                        <img src="{{ asset('storage/photos/' . $deposit->proof) }}"
                                                                            alt="Payment proof" title=""
                                                                            class="img-fluid" />
                                                                    @else
                                                                        @php
                                                                            $ppath = 'storage/' . $deposit->proof;
                                                                            if (Storage::disk('s3')->exists($ppath)) {
                                                                                $passurl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                                                                                $passfile = Storage::disk('s3')->get($ppath);
                                                                                $psrc = $passurl . $passfile;
                                                                            } else {
                                                                                $psrc = '';
                                                                            }
                                                                        @endphp
                                                                        <img src="{{ $psrc }}"
                                                                            alt="Proof of Payment" title=""
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /POP Modal -->

                                                <!-- Send Message Modal -->
                                                <div id="sendMessageModal{{ $deposit->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> Send Deposit
                                                                    Email
                                                                    {{ $deposit->duser->name }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="">
                                                                    This message will be sent to
                                                                    {{ $deposit->duser->name }}
                                                                    {{ $deposit->duser->l_name }}
                                                                </h4>
                                                                <form style="padding:3px;" role="form" method="post"
                                                                    action="{{ route('sendmailtooneuser') }}">
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $deposit->duser->id }}">
                                                                    <textarea class="form-control" name="message" row="3" required>This is to inform you that your deposit of {{ \App\Models\Setting::getValue('currency') }}{{ $deposit->amount }} has been received and processed. You can now check your Trader7 account.</textarea>
                                                                    <br />
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="type" value="deposit">
                                                                    <input type="submit" class="btn btn-primary"
                                                                        value="Send">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Send Message Modal -->
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
                    [7, 'desc']
                ],
                'pageLength': 100,
            });
        });
    </script>
@endsection
