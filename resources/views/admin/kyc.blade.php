@extends('layouts.app')

@section('title', 'Manage KYC')

@section('musers-li', 'selected')
@section('mkyc', 'active')

@section('content')

    @include('admin.topmenu')
    @include('admin.sidebar')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bolder">
                        <h1 class="title1 text-center">
                            {{ \App\Models\Setting::getValue('site_name') }}
                            KYC Verifications</h1>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <i class="fa fa-info-circle"></i>
                                        <p class="alert-message">{{ Session::get('message') }}</p>
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
                                <div class="bs-example table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable"
                                        class="table table-bordered table-striped table-responsive-sm yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Full name</th>
                                                <th>Email</th>
                                                <th>KYC Status</th>
                                                <th>Uploaded Date</th>
                                                <th>Verified Date</th>
                                                <th>Docs</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td><span
                                                            class="badge @if ($user->account_verify == 'Under Review') badge-primary @elseif($user->account_verify == 'Verified') badge-success @endif">{{ $user->account_verify }}</span>
                                                    </td>
                                                    <td>{{ $user->docs_uploaded_date }}</td>
                                                    <td>{{ $user->docs_verified_date }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#viewkycIModal{{ $user->id }}"
                                                            class="badge badge-primary" style="paddig: 20px;"><i
                                                                class="fa fa-eye"></i>
                                                            ID</a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#viewkycIBModal{{ $user->id }}"
                                                            class="badge badge-primary" style="paddig: 20px;"><i
                                                                class="fa fa-eye"></i> ID
                                                            Back</a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#viewkycAModal{{ $user->id }}"
                                                            class="badge badge-primary" style="paddig: 20px;"><i
                                                                class="fa fa-eye"></i>
                                                            Address Document</a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#viewkycPModal{{ $user->id }}"
                                                            class="badge badge-primary" style="paddig: 20px;"><i
                                                                class="fa fa-eye"></i>
                                                            Passport</a>
                                                    </td>
                                                    <td>
                                                        @if (auth('admin')->user()->hasPermissionTo('mkyc-validate', 'admin'))
                                                            {{-- @if ($user->account_verify != 'Verified') --}}
                                                            <a href="{{ route('acceptkyc', $user->id) }}"
                                                                class="btn btn-success btn-sm">Accept</a>
                                                            <a href="{{ route('rejectkyc', $user->id) }}"
                                                                class="btn btn-danger btn-sm">Reject</a>
                                                            {{-- @else --}}
                                                            <a href="{{ route('resetkyc', $user->id) }}"
                                                                class="btn btn-danger btn-sm">Reset Verification</a>
                                                            {{-- @endif --}}
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- View KYC ID Modal -->
                                                <div id="viewkycIModal{{ $user->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">KYC verification -
                                                                    ID card view</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if (\App\Models\Setting::getValue('location') == 'Email')
                                                                    <h3 class="">Check your email with the
                                                                        KYC upload that has an attachment name of
                                                                        <span
                                                                            class="text-danger">{{ $user->id_card }}</span>
                                                                    </h3>
                                                                @elseif(\App\Models\Setting::getValue('location') == 'Local')
                                                                    <img src="{{ asset('storage/photos/' . $user->id_card) }}"
                                                                        alt="ID Card" title="" class="img-fluid" />
                                                                @elseif(\App\Models\Setting::getValue('location') == 'S3')
                                                                    @php
                                                                        $path = 'storage/' . $user->id_card;
                                                                        if (Storage::disk('s3')->exists($path)) {
                                                                            $logourl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                                                                            $logofile = Storage::disk('s3')->get($path);
                                                                            $src = $logourl . $logofile;
                                                                        } else {
                                                                            $src = '';
                                                                        }
                                                                    @endphp
                                                                    <img src="$src" alt="ID Card" title=""
                                                                        class="img-fluid" />
                                                                @else
                                                                    <img src="{{ asset('storage/photos/' . $user->passport) }}"
                                                                        alt="Passport" title="" class="img-fluid" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /view KYC ID Modal -->

                                                <!-- View KYC ID Back Modal -->
                                                <div id="viewkycIBModal{{ $user->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">KYC verification -
                                                                    ID Back card view</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if (\App\Models\Setting::getValue('location') == 'Email')
                                                                    <h3 class="">Check your email with the
                                                                        KYC upload that has an attachment name of
                                                                        <span
                                                                            class="text-danger">{{ $user->id_card_back }}</span>
                                                                    </h3>
                                                                @elseif(\App\Models\Setting::getValue('location') == 'Local')
                                                                    <img src="{{ asset('storage/photos/' . $user->id_card_back) }}"
                                                                        alt="ID Back Card" title=""
                                                                        class="img-fluid" />
                                                                @elseif(\App\Models\Setting::getValue('location') == 'S3')
                                                                    @php
                                                                        $path = 'storage/' . $user->id_card_back;
                                                                        if (Storage::disk('s3')->exists($path)) {
                                                                            $logourl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                                                                            $logofile = Storage::disk('s3')->get($path);
                                                                            $src = $logourl . $logofile;
                                                                        } else {
                                                                            $src = '';
                                                                        }
                                                                    @endphp
                                                                    <img src="$src" alt="ID Card Back" title=""
                                                                        class="img-fluid" />
                                                                @else
                                                                    <img src="{{ asset('storage/photos/' . $user->passport) }}"
                                                                        alt="Passport" title=""
                                                                        class="img-fluid" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /view KYC ID Back Modal -->

                                                <!-- View KYC Passport Modal -->
                                                <div id="viewkycPModal{{ $user->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">KYC verification -
                                                                    Passport view</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">

                                                                @if (\App\Models\Setting::getValue('location') == 'Email')
                                                                    <h3 class="">Check your email with the
                                                                        KYC upload that has an attachment name of
                                                                        <span
                                                                            class="text-danger">{{ $user->passport }}</span>
                                                                    </h3>
                                                                @elseif(\App\Models\Setting::getValue('location') == 'S3')
                                                                    @php
                                                                        $ppath = 'storage/' . $user->passport;
                                                                        if (Storage::disk('s3')->exists($ppath)) {
                                                                            $passurl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                                                                            $passfile = Storage::disk('s3')->get($ppath);
                                                                            $psrc = $passurl . $passfile;
                                                                        } else {
                                                                            $psrc = '';
                                                                        }
                                                                    @endphp
                                                                    <img src="$psrc" alt="Passport" title=""
                                                                        class="img-fluid" />
                                                                @else
                                                                    <img src="{{ asset('storage/photos/' . $user->passport) }}"
                                                                        alt="Passport" title=""
                                                                        class="img-fluid" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /view KYC Passport Modal -->

                                                <!-- View KYC Address Modal -->
                                                <div id="viewkycAModal{{ $user->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">KYC verification -
                                                                    Address Document view</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">

                                                                @if (\App\Models\Setting::getValue('location') == 'Email')
                                                                    <h3 class="">Check your email with the
                                                                        KYC upload that has an attachment name of
                                                                        <span
                                                                            class="text-danger">{{ $user->address_document }}</span>
                                                                    </h3>
                                                                @elseif(\App\Models\Setting::getValue('location') == 'S3')
                                                                    @php
                                                                        $ppath = 'storage/' . $user->address_document;
                                                                        if (Storage::disk('s3')->exists($ppath)) {
                                                                            $passurl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                                                                            $passfile = Storage::disk('s3')->get($ppath);
                                                                            $psrc = $passurl . $passfile;
                                                                        } else {
                                                                            $psrc = '';
                                                                        }
                                                                    @endphp
                                                                    <img src="$psrc" alt="Address" title=""
                                                                        class="img-fluid" />
                                                                @else
                                                                    <img src="{{ asset('storage/photos/' . $user->address_document) }}"
                                                                        alt="Address Document" title=""
                                                                        class="img-fluid" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /view KYC Address Modal -->

                                            @empty
                                                <tr>
                                                    <td colspan="7">No data available</td>
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
                    [4, 'desc']
                ],
                'pageLength': 100,
            });
        });
    </script>
@endsection
