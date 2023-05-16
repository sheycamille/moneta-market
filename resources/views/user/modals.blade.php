<!-- Deposit Modal -->
<div id="depositModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.modal.make_new')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="get" action="{{ route('selectpaymentmethod') }}">
                    <input style="padding:5px;" class="form-control" placeholder="@lang('message.modal.enter')" type="number"
                        name="amount" min="{{ \App\Models\Setting::getValue('min_dw') }}" required>
                    <br />

                    <select required class="form-control" name="account_id" id="account_id" required>
                        <option value="" disabled>@lang('message.modal.chose')</option>
                        @foreach (Auth::user()->accounts() as $account)
                            <option value="{{ $account->id }}">{{ $account->number }} |  USD {{ $account->balance }}
                            </option>
                        @endforeach
                    </select> <br>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Continue">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /deposit Modal -->


<!-- Withdrawal Modal -->
<div id="withdrawalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.modal.pay').</h4>
                <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-dark">
                <form style="padding:3px;" role="form" method="post" action="{{ route('withdrawal') }}">
                    <input style="padding:5px;" class="form-control" placeholder="Enter amount here" type="text"
                        name="amount" required><br />

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="@lang('message.modal.sub')">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Withdrawals Modal -->


<!-- New Demo Account modal -->
<div id="newDemoAccountModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.modal.demo')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('account.addt7account') }}" id="demoAccForm">
                    @csrf
                    <input class="form-control" value="demo" type="hidden" name="type">
                    <h5 class="">@lang('message.account_name')*:</h5>
                    <input class="form-control" value="" type="text" name="name">

                    <h5 class="">@lang('message.modal.lev')*:</h5>
                    <select class="form-control" name="leverage" class="leverage" required>
                        <option disabled>@lang('message.modal.sl')</option>
                        <option value="500">1:500</option>
                        <option value="400">1:400</option>
                        <option value="300">1:300</option>
                        <option value="200">1:200</option>
                        <option value="100">1:100</option>
                    </select><br>
                    {{-- <h5 class="">@lang('message.modal.pass')*:</h5>
                    <input style="padding:5px;" class="form-control" type="text" name="password" required><br />
                    <h5 class="">@lang('message.modal.ivs')*:</h5>
                    <input style="padding:5px;" class="form-control" type="text" name="investor_password"
                        required><br /> --}}
                    {{-- <h5 class="">@lang('message.modal.cur')*:</h5>
                    <input class="form-control" Placeholder="E.g. usd" type="text" name="currency" required><br /> --}}
                    {{-- <h5 class="">@lang('message.modal.int')*:</h5>
                    <input class="form-control" Placeholder="E.g. 100,000" type="text" name="balance" value="100000"
                        required><br /> --}}
                    <input type="submit" class="btn btn-primary" value="@lang('message.modal.sub')">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<!-- New Live Modal modal -->
<div id="newLiveAccountModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('message.modal.live')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('account.addt7account') }}"
                    id="liveAccform">
                    @csrf
                    <input class="form-control" value="live" type="hidden" name="type">
                    <h5 class="">@lang('message.account_name')*:</h5>
                    <input class="form-control" value="" type="text" name="name">

                    <h5 class="">@lang('message.modal.lev')*:</h5>
                    <select class="form-control" name="leverage" class="leverage" required>
                        <option disabled>@lang('message.modal.sl')</option>
                        <option value="500">1:500</option>
                        <option value="400">1:400</option>
                        <option value="300">1:300</option>
                        <option value="200">1:200</option>
                        <option value="100">1:100</option>
                    </select><br>
                    {{-- <h5 class="">@lang('message.modal.pass')*:</h5>
                    <input style="padding:5px;" class="form-control" type="text" name="password" required><br />
                    <h5 class="">@lang('message.modal.ivs')*:</h5>
                    <input style="padding:5px;" class="form-control" type="text" name="investor_password"
                        required><br /> --}}
                    {{-- <h5 class="">@lang('message.modal.cur')*:</h5>
                    <input class="form-control" Placeholder="E.g. usd" type="text" name="currency" required><br /> --}}
                    {{-- <h5 class="">@lang('message.modal.int') *:</h5>
                    <input class="form-control" Placeholder="E.g. 10,0000" type="text" name="balance" required><br /> --}}
                    <input type="submit" class="btn btn-primary" value="@lang('message.modal.sub')">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
