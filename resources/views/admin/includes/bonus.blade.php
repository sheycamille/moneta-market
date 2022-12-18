<form method="post" action="{{route('updatebotswt')}}" enctype="multipart/form-data">

    <div class="form-group">
        <label for=""></label>
        <h5 class="">Direct Referral Commission (%) </h5>
        <input type="text" class="form-control" name="ref_commission"
            value="{{\App\Models\Setting::getValue('referral_commission')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Indirect Referral Commission 1 (%) </h5>
        <input type="text" class="form-control" name="ref_commission1"
            value="{{\App\Models\Setting::getValue('referral_commission1')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Indirect Referral Commission 2 (%) </h5>
        <input type="text" class="form-control" name="ref_commission2"
            value="{{\App\Models\Setting::getValue('referral_commission2')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Indirect Referral Commission 3 (%) </h5>
        <input type="text" class="form-control" name="ref_commission3"
            value="{{\App\Models\Setting::getValue('referral_commission3')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Indirect Referral Commission 4 (%) </h5>
        <input type="text" class="form-control" name="ref_commission4"
            value="{{\App\Models\Setting::getValue('referral_commission4')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Indirect Referral Commission 5 (%) </h5>
        <input type="text" class="form-control " name="ref_commission5"
            value="{{\App\Models\Setting::getValue('referral_commission5')}}" required>
    </div>

    <div class="form-group">
        <h5 class="">Registration Bonus({{currency}})</h5>
        <input type="text" class="form-control" name="signup_bonus"
            value="{{\App\Models\Setting::getValue('signup_bonus')}}" required>
    </div>

    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"><br />
</form>
