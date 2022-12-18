<!-- send all users email -->
<div id="sendmailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">This message will be sent to all your users.</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post" action="{{ route('sendmailtoall') }}">

                    <textarea class="form-control" name="message" row="3" placeholder="Type Message here"
                        required></textarea><br />

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /send all users email Modal -->

<!-- Withdrawal method Modal -->
<div id="wmethodModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new withdrawal method</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post" action="{{ route('addwdmethod') }}"
                    enctype="multipart/form-data">
                    <input style="padding:5px;" class="form-control" placeholder="Enter method name" type="text"
                        name="name" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Enter method exchange symbol"
                        type="text" name="exchange_symbol" value=""><br>
                    <input style="padding:5px;" class="form-control" placeholder="Enter method setting key" type="text"
                        name="setting_key" value=""><br>
                    <input style="padding:5px;" class="form-control" placeholder="Minimum amount $" type="text"
                        name="minimum" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Maximum amount $" type="text"
                        name="maximum" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Charges (Fixed amount $)" type="text"
                        name="charges_fixed" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Charges (Percentage %)" type="text"
                        name="charges_percentage" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Payout duration" type="text"
                        name="duration" required><br />
                    <select style="padding:5px;" class="form-control" placeholder="Permitted Countries" type="text"
                        name="countries[]" required style="max-width: 150px" multiple>
                        <option disabled>@lang('message.register.chs')</option>
                        @foreach (\App\Models\Country::get() as $country)
                        <option @if ($country->id == old('country')) selected @endif value="{{ $country->id }}">
                            {{ $country->name }}</option>
                        @endforeach
                    </select><br />
                    <textarea class="form-control" name="details" row="3" placeholder="Method details"></textarea><br />
                    <select name="status" class="form-control">
                        <option value="">Select action</option>
                        <option value="enabled">Enable</option>
                        <option value="disabled">Disable</option>
                    </select><br />
                    <div class="form-group">
                        <h5 class="">Logo</h5>
                        <input name="logo" class="form-control" type="file">
                    </div><br />
                    <input type="hidden" name="type" value="withdrawal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Continue">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /withdrawal method Modal -->


<!-- Deposit method Modal -->
<div id="dmethodModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Deposit Method</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post" action="{{ route('addwdmethod') }}"
                    enctype="multipart/form-data">
                    <input style="padding:5px;" class="form-control" placeholder="Enter method name" type="text"
                        name="name" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Enter method exchange symbol"
                        type="text" name="exchange_symbol" value=""><br>
                    <input style="padding:5px;" class="form-control" placeholder="Enter method setting key" type="text"
                        name="setting_key" value=""><br>
                    <input style="padding:5px;" class="form-control" placeholder="Minimum amount $" type="text"
                        name="minimum" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Maximum amount $" type="text"
                        name="maximum" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Charges (Fixed amount $)" type="text"
                        name="charges_fixed" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Charges (Percentage %)" type="text"
                        name="charges_percentage" required><br />
                    <input style="padding:5px;" class="form-control" placeholder="Payout duration" type="text"
                        name="duration" required><br />
                    <select style="padding:5px;" class="form-control" placeholder="Permitted Countries" type="text"
                        name="countries[]" required style="max-width: 150px" multiple>
                        <option disabled>@lang('message.register.chs')</option>
                        @foreach (\App\Models\Country::get() as $country)
                        <option @if ($country->id == old('country')) selected @endif value="{{ $country->id }}">
                            {{ $country->name }}</option>
                        @endforeach
                    </select><br>
                    <textarea class="form-control" name="details" rows="10" cols="20"
                        placeholder="Method details"></textarea><br />
                    <select name="status" class="form-control">
                        <option value="">Select action</option>
                        <option value="enabled">Enable</option>
                        <option value="disabled">Disable</option>
                    </select><br />
                    <div class="form-group">
                        <h5 class="">Logo</h5>
                        <input name="logo" class="form-control" type="file">
                    </div><br />
                    <input type="hidden" name="type" value="deposit">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Continue">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Deposit method Modal -->


<!-- Account Type Modal -->
<div id="accountTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Account Type</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post" action="{{ route('addaccounttype') }}">
                    <h5 class="">Name</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter name" type="text" name="name"
                        required><br />
                    <h5 class="">Cosy</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter price" type="text" name="price"
                        required><br />
                    <h5 class=""> Minimum Price</h5>
                    <input style="padding:5px;" placeholder="Enter minimum price" class="form-control" type="text"
                        name="min_price" required><br />
                    <h5 class=""> Maximum Price</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter maximum price" type="text"
                        name="max_price" required><br />

                    <h5 class="">Minimum return</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter minimum return" type="text"
                        name="minr" required><br />

                    <h5 class="">Maximum return</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter maximum return" type="text"
                        name="maxr" required><br />
                    <h5 class="">Gift Bonus</h5>
                    <input style="padding:5px;" class="form-control" placeholder="Enter Additional Gift Bonus"
                        type="text" name="gift" required><br />
                    <h5 class="">top up interval</h5>
                    <select class="form-control" name="t_interval">
                        <option>Monthly</option>
                        <option>Weekly</option>
                        <option>Daily</option>
                        <option>Hourly</option>
                    </select> <br>
                    <h5 class="">top up type</h5>
                    <select class="form-control" name="t_type">
                        <option>Percentage</option>
                        <option>Fixed</option>
                    </select> <br>
                    <h5 class="">top up amount (in % or $ as specified above)</h5>
                    <input style="padding:5px;" class="form-control" placeholder="top up amount" type="text"
                        name="t_amount" required> <br>
                    <h5 class="">Investment duration</h5>
                    <select class="form-control" name="expiration">
                        <option>One week</option>
                        <option>One month</option>
                        <option>Three months</option>
                        <option>Six months</option>
                        <option>One year</option>
                    </select><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Add Account Type">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Account Type Modal -->


<!-- settings update Modal -->
<div id="s_updModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title" style="text-align:center;">This settings page was last updated by</h4>
                <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-dark">
                <h3>{{ \App\Models\Setting::getValue('updated_by') }}</h3>
                <h4 class="modal-title" style="text-align:center;">Date/Time</h4>
                <h3>{{ \App\Models\Setting::getValue('updated_at') }}</h3>
            </div>
        </div>
    </div>
</div>
<!-- /settings update Modal -->
