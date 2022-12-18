<!-- Top Up Modal -->
<div id="topupModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align:center;">Credit/Debit User Account</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form style="padding: 3px;" role="form" method="post" action="{{ route('topup') }}">
                    <input style="padding: 10px;" class="form-control" value="{{ $user->id }}" type="text"
                        disabled><br />
                    <select required class="form-control" name="account_id" id="account_id" required>
                        <option value="" disabled selected>Choose Acount</option>
                        @foreach ($user->accounts() as $account)
                            <option value="{{ $account->id }}">{{ $account->number }} |
                                USD {{ $account->balance }}
                            </option>
                        @endforeach
                    </select>
                    <br>

                    <h5 class="">Amount</h5>
                    <input style="padding: 10px;" class="form-control" placeholder="Enter amount" type="text"
                        name="amount" required>
                    <br>

                    <h5 class="">Select credit to add, debit to subtract.</h5>
                    <select class="form-control" name="t_type" required>
                        <option value="">Select type</option>
                        <option value="Credit">Credit</option>
                        <option value="Debit">Debit</option>
                    </select>
                    <br><br>

                    <h5 class="">Select where to Credit/Debit</h5>
                    <select class="form-control" name="type" required>
                        <option value="">Select Column</option>
                        <option value="Balance">Balance</option>
                        <option value="Bonus">Bonus</option>
                        <option value="Credit">Credit</option>
                    </select>
                    <br><br>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="submit" class="btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Topup Modal -->


<!-- send a single user email Modal-->
<div id="sendmailtooneuserModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Email Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>This message will be sent to
                    @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif
                </p>
                <form style="padding:3px;" role="form" method="post"
                    action="{{ route('sendmailtooneuser', $user->id) }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <textarea placeholder="Type your message here" class="form-control" name="message" row="3"
                        placeholder="Type your message here" required></textarea><br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- /Trading History Modal -->
<div id="TradingModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Add Trading History for
                    @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('addhistory') }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <h5 class="">Amount</h5>
                    <input type="number" name="amount" class="form-control">
                    <div class="form-group">
                        <h5 class="">Type</h5>
                        <select class="form-control" name="type">
                            <option value="">Select type</option>
                            <option value="Bonus">Bonus</option>
                            {{-- <option value="ROI">ROI</option> --}}
                        </select>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Add History">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /send a single user email Modal -->


<!-- Edit user Modal -->
<div id="edituser{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Edit User</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post"
                    action="{{ route('updateuser', $user->id) }}">
                    <input style="padding:5px;" class="form-control"
                        value="@if ($user->name) {{ $user->name }}
                            @else
                                {{ $user->first_name . ' ' . $user->last_name }} @endif"
                        type="text" disabled><br />

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="first_name">@lang('message.first_name')</label>
                            <input class="form-control" id="first_name" type="text" name="first_name"
                                placeholder="@lang('message.first_name')" value="{{ $user->first_name }}">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="last_name">@lang('message.last_name')</label>
                            <input class="form-control" id="last_name" type="text" name="last_name"
                                placeholder="@lang('message.last_name')" value="{{ $user->last_name }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email">@lang('message.body.email') </label>
                            <input class="form-control" id="email" type="text" name="email"
                                placeholder="@lang('message.body.enter_email')" value="{{ $user->email }}">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="dob">@lang('message.dob')</label>
                            <input class="form-control" id="dob" type="date" name="dob"
                                placeholder="@lang('message.dob')" value="{{ $user->dob }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="phone">@lang('message.body.phone')</label>
                            <input class="form-control" id="phone" type="text" name="phone"
                                placeholder="@lang('message.body.enter_phone')" value="{{ $user->phone }}">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="postal-code">@lang('message.body.zip') /
                                @lang('message.postal_code')</label>
                            <input class="form-control" id="postal-code" type="text" placeholder="Zip Code"
                                name="zip_code" value="{{ $user->zip_code }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="country">@lang('message.register.country')</label>
                            <select class="form-control" name="country" id="country" required>
                                <option selected disabled>
                                    @lang('message.body.country')
                                </option>
                                @foreach ($countries as $country)
                                    <option @if ($user->country_id == $country->id || $user->country_id == $country->name) selected @endif
                                        value="{{ $country->id }}">
                                        {{ ucfirst($country->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address">@lang('message.address')</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}"
                                id="address" placeholder="@lang('message.address')">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="state">@lang('message.register.state')</label>
                            <input type="text" class="form-control" name="state" value="{{ $user->state }}"
                                id="state" placeholder="@lang('message.register.enter_stt')">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city">@lang('message.body.city')</label>
                            <input type="text" class="form-control" name="town" value="{{ $user->town }}"
                                id="town" placeholder="@lang('message.register.town')">
                        </div>
                    </div>

                    <h5 class="">Referral link</h5>
                    <input style="padding:5px;" class="form-control" value="{{ $user->ref_link }}" type="text"
                        name="ref_link"><br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="submit" class="btn btn-primary" value="Update user">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit user Modal -->


<!-- Reset user password Modal -->
<div id="resetpswdModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reset Password</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="">Are you sure you want to reset password for @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif to <span class="text-primary font-weight-bolder">user01236</span></p>
                <a class="btn btn-primary" href="{{ route('resetpswd', $user->id) }}">Reset
                    Now</a>
            </div>
        </div>
    </div>
</div>
<!-- /Reset user password Modal -->


<!-- Switch useraccount Modal -->
<div id="switchuserModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">You are about to login as
                    @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif</strong>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <a class="btn btn-primary" target="_bank" href="{{ route('switchtouser', $user->id) }}">Proceed</a>
            </div>
        </div>
    </div>
</div>
<!-- /Switch user account Modal -->


<!-- Clear account Modal -->
<div id="clearacctModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Clear Account</strong></h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>You are clearing account for @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif to $0.00</p>
                <a class="btn btn-primary" href="{{ route('clearacct', $user->id) }}">Proceed</a>
            </div>
        </div>
    </div>
</div>
<!-- /Clear account Modal -->


<!-- Delete user Modal -->
<div id="deleteModal{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Delete User</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <p class="">Are you sure you want to delete
                    @if ($user->name)
                        {{ $user->name }}
                    @else
                        {{ $user->first_name . ' ' . $user->last_name }}
                    @endif
                </p>
                <a class="btn btn-danger" href="{{ route('deluser', $user->id) }}">Yes, I'm sure</a>
            </div>
        </div>
    </div>
</div>
<!-- /Delete user Modal -->


<!-- Live Trader7 Account Mg't  Modal -->
{{-- <div id="liveaccounts{{ $user->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Trader7 Accounts</strong></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="accountstable table table-hover">
                    <div class="row">
                        <div class="cell">ID</div>
                        <div class="cell">Number</div>
                        <div class="cell">Balance</div>
                        <div class="cell">Action</div>
                    </div>
                    @foreach ($user->accounts() as $acc)
                        <div class="row">
                            <div class="cell" scope="row">{{ $acc->id }} </div>
                            <div class="cell">{{ $acc->login }} </div>
                            <div class="cell">{{ $acc->balance }} </div>
                            <div class="cell">
                                <a href="{{ route('dellaccounts', $acc->id) }}"
                                    class="m-1 btn btn-danger btn-xs">Delete
                                    Account</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> --}}
<style>
    .cell {
        margin-right: 2%;
    }
</style>
<!-- /Live Trader7 Account Mg't  Modal -->
