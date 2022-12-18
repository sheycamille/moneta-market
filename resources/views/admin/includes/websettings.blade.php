<form method="post" action="{{ route('updatepreference') }}" enctype="multipart/form-data">
    <div class="form-group">
        <h5 class="">Contact Email</h5>
        <input type="text" class="form-control" name="contact_email"
            value="{{ \App\Models\Setting::getValue('contact_email') }}" required>
    </div>

    <div class="sign-up1">
        <h3 class=""> Deposit Email:</h3>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="deposit_email"
            value="{{ \App\Models\Setting::getValue('deposit_email') }}" required>
    </div> <br>

    <div class="sign-up1">
        <h3 class=""> Withdrawal Email:</h3>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="withdrawal_email"
            value="{{ \App\Models\Setting::getValue('withdrawal_email') }}" required>
    </div> <br>

    <div class="sign-up1">
        <h3 class=""> Verification email:</h3>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="verification_email"
            value="{{ \App\Models\Setting::getValue('verification_email') }}" required>
    </div> <br>


    <div class="form-group">
        <h5 class="">Uploaded Files Location</h5>
        <small class="">Note: To use AWS S3, please supply your AWS information in the .ENV
            file</small>
        <select name="location" class="form-control">
            <option @if (\App\Models\Setting::getValue('location')=='Local' ) selected @endif value="Local">Local
            </option>
            <option @if (\App\Models\Setting::getValue('location')=='S3' ) selected @endif value="S3">AWS S3</option>
            <option @if (\App\Models\Setting::getValue('location')=='Email' ) selected @endif value="Email">Email
            </option>
        </select><br />
    </div>

    <input name="s_currency" value="{{ \App\Models\Setting::getValue('s_currency') }}" id="s_c" type="hidden">
    <div class="form-group">
        <h5 class="">Website Currency</h5>
        <select name="currency" id="select_c" class="form-control" onchange="s_f()">
            <option value="<?php echo htmlentities(\App\Models\Setting::getValue('currency')); ?>">
                {{ \App\Models\Setting::getValue('currency') }}</option>
            @foreach ($currencies as $key => $currency)
            <option id="{{ $key }}" value="<?php echo html_entity_decode($currency); ?>">
                {{ $key . ' (' . html_entity_decode($currency) . ')' }}</option>
            @endforeach
        </select>
    </div>

    <script>
        function s_f() {
            var e = document.getElementById("select_c");
            var selected = e.options[e.selectedIndex].id;
            document.getElementById("s_c").value = selected;
        }
    </script>

    <input type="hidden" value="{{ \App\Models\Setting::getValue('site_preference') }}" name="site_preference">

    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="">Turn off/on Annoucment: </h5>
            </div>
            <div class="sign-up2">
                <label class="switch">
                    <input name="enable_annoc" id="enable_annoc" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>

    {{-- <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="">Turn off/on Weekend Trade:</h5>
            </div>
            <div class="sign-up2">
                <small class="">if turned off, Users will not receive ROI on weekends</small>
                <br>
                <label class="switch">
                    <input name="weekend_trade" id="weekend_trade" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div> --}}

    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class=""> Disable/Enable Withdrawal:</h5>
            </div>
            <div class="sign-up2">
                <small class="">if turned on, Users will not be able to Withdraw</small> <br>
                <label class="switch">
                    <input name="enable_withdrawal" id="enable_withdrawal" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>

    {{-- <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="">Turn off/on Google Translate</h5>
            </div>
            <div class="sign-up2">
                <small class="">if turned on, Users will have the option of changing their
                    language through google translate.</small> <br>
                <label class="switch">
                    <input name="googlet" id="googlet" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div> --}}

    {{-- <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="">Turn off/on trade: </h5>
            </div>
            <div class="sign-up2">
                <label class="switch">
                    <input name="trade_mode" id="trade_mode" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div> --}}

    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="">Turn off/on KYC:</h5>
            </div>
            <div class="sign-up2">
                <label class="switch">
                    <input name="enable_kyc" id="enable_kyc" type="checkbox" value="on">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>

    @if (\App\Models\Setting::getValue('enable_annoc') == 'yes')
    <script>
        document.getElementById("enable_annoc").checked = true;
    </script>
    @endif

    {{-- @if (\App\Models\Setting::getValue('googlet') == 'yes')
    <script>
        document.getElementById("googlet").checked = true;
    </script>
    @endif --}}

    {{-- @if (\App\Models\Setting::getValue('trade_mode') == 'yes')
    <script>
        document.getElementById("trade_mode").checked = true;
    </script>
    @endif --}}

    @if (\App\Models\Setting::getValue('enable_kyc') == 'yes')
    <script>
        document.getElementById("enable_kyc").checked = true;
    </script>
    @endif

    {{-- @if (\App\Models\Setting::getValue('weekend_trade') == 'yes')
    <script>
        document.getElementById("weekend_trade").checked = true;
    </script>
    @endif --}}

    @if (\App\Models\Setting::getValue('enable_withdrawal') == 'yes')
    <script>
        document.getElementById("enable_withdrawal").checked = true;
    </script>
    @endif

    <input type="submit" class="px-5 mb-2 btn btn-primary btn-lg" value="Save">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"><br />
</form>
