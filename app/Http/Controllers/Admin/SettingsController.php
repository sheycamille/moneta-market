<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Setting;
use App\Models\Wdmethod;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SettingsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:msetting-list|msetting-create|msetting-edit|msetting-delete', ['only' => ['index', 'prefsettings', 'paysettings']]);
        $this->middleware('permission:msetting-create', ['only' => ['create', 'store', 'addwdmethod']]);
        $this->middleware('permission:msetting-edit', ['only' => ['updatewebinfo', 'updatepreference', 'updatesettings', 'updatewdmethod']]);
        $this->middleware('permission:msetting-delete', ['only' => ['destroy', 'deletewdmethod']]);
    }



    //return settings form
    public function index()
    {
        $countries = Country::whereStatus('active')->get();
        return view('admin.settings')->with(array(
            //'markets' => markets::all(),
            'countries' => $countries,
            'title' => 'System Info Settings'
        ));
        //return view('settings')->with(array('title' =>'System Settings'));
    }


    //return settings form
    public function prefsettings(Request $request)
    {
        include "currencies.php";
        return view('admin.prefsettings', compact('currencies'));
    }


    //return settings form
    public function paysettings(Request $request)
    {
        $countries = Country::whereStatus('active')->get();
        $wmethods = Wdmethod::where('type', 'withdrawal')->get();
        $dmethods = Wdmethod::where('type', 'deposit')->get();
        return view('admin.paysettings')->with(array(
            'wmethods' => $wmethods,
            'dmethods' => $dmethods,
            'countries' => $countries,
            'title' => 'System Settings'
        ));
    }


    public function updatewebinfo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'mimes:jpg,jpeg,png|max:500|image',
            'favicon' => 'mimes:jpg,jpeg,png|max:500|image',
        ]);

        $strtxt = $this->generate_string(6);

        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $logoname = $strtxt . $file->getClientOriginalName();
            // save to storage/app/uploads as the new $filename
            $path = $file->storeAs('public/photos', $logoname);

            $setting = Setting::where('name', 'logo')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'logo';
            $setting->value = $logoname;
            $setting->save();
        }

        if ($request->hasfile('favicon')) {
            $favfile = $request->file('favicon');
            $favname = $strtxt . $favfile->getClientOriginalName();
            // save to storage/app/uploads as the new $filename
            $pathfav = $favfile->storeAs('public/photos', $favname);

            $setting = Setting::where('name', 'favicon')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'favicon';
            $setting->value = $favname;
            $setting->save();
        }

        if ($request->site_name) {
            $setting = Setting::where('name', 'site_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'site_name';
            $setting->value = $request->site_name;
            $setting->save();
        }

        if ($request->description) {
            $setting = Setting::where('name', 'description')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'description';
            $setting->value = $request->description;
            $setting->save();
        }

        if ($request->keywords) {
            $setting = Setting::where('name', 'keywords')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'keywords';
            $setting->value = $request->keywords;
            $setting->save();
        }

        if ($request->site_title) {
            $setting = Setting::where('name', 'site_title')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'site_title';
            $setting->value = $request->site_title;
            $setting->save();
        }

        if ($request->tawk_to) {
            $setting = Setting::where('name', 'tawk_to')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'tawk_to';
            $setting->value = $request->tawk_to;
            $setting->save();
        }

        if ($request->site_address) {
            $setting = Setting::where('name', 'site_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'site_address';
            $setting->value = $request->site_address;
            $setting->save();
        }

        if ($request->update) {
            $setting = Setting::where('name', 'newupdate')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'newupdate';
            $setting->value = $request->update;
            $setting->save();
        }

        // $setting = Setting::where('name', 'update_by')->first();
        // if (!$setting) $setting = new Setting();
        // $setting->name = 'update_by';
        // $setting->value = \Auth::user()->tuser()->first_name .  ' ' . \Auth::user()->tuser()->last_name;
        // $setting->save();

        return redirect()->back()
            ->with('message', 'Action Sucessful');
    }


    public function updatepreference(Request $request)
    {
        if ($request->contact_email) {
            $setting = Setting::where('name', 'contact_email')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'contact_email';
            $setting->value = $request->contact_email;
            $setting->save();
        }

        if ($request->deposit_email) {
            $setting = Setting::where('name', 'deposit_email')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'deposit_email';
            $setting->value = $request->deposit_email;
            $setting->save();
        }

        if ($request->withdrawal_email) {
            $setting = Setting::where('name', 'withdrawal_email')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'withdrawal_email';
            $setting->value = $request->withdrawal_email;
            $setting->save();
        }

        if ($request->verification_email) {
            $setting = Setting::where('name', 'verification_email')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'verification_email';
            $setting->value = $request->verification_email;
            $setting->save();
        }

        if ($request->currency) {
            $setting = Setting::where('name', 'currency')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'currency';
            $setting->value = $request->currency;
            $setting->save();
        }

        if ($request->s_currency) {
            $setting = Setting::where('name', 's_currency')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 's_currency';
            $setting->value = $request->s_currency;
            $setting->save();
        }

        if ($request->site_preference) {
            $setting = Setting::where('name', 'site_preference')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'site_preference';
            $setting->value = $request->site_preference;
            $setting->save();
        }

        if ($request->location) {
            $setting = Setting::where('name', 'location')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'location';
            $setting->value = $request->location;
            $setting->save();
        }

        if (isset($request['trade_mode']) and $request['trade_mode'] == 'on') {
            $trade_mode = "yes";
        } else {
            $trade_mode = "no";
        }
        $setting = Setting::where('name', 'trade_mode')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'trade_mode';
        $setting->value = $trade_mode;
        $setting->save();

        if (isset($request['googlet']) and $request['googlet'] == 'on') {
            $googlet = "yes";
        } else {
            $googlet = "no";
        }
        $setting = Setting::where('name', 'googlet')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'googlet';
        $setting->value = $googlet;
        $setting->save();

        if (isset($request['enable_kyc']) and $request['enable_kyc'] == 'on') {
            $enable_kyc = "yes";
        } else {
            $enable_kyc = "no";
        }
        $setting = Setting::where('name', 'enable_kyc')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'enable_kyc';
        $setting->value = $enable_kyc;
        $setting->save();

        if (isset($request['weekend_trade']) and $request['weekend_trade'] == 'on') {
            $weekend_trade = "yes";
        } else {
            $weekend_trade = "no";
        }
        $setting = Setting::where('name', 'weekend_trade')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'weekend_trade';
        $setting->value = $weekend_trade;
        $setting->save();


        if (isset($request['enable_withdrawal']) and $request['enable_withdrawal'] == 'on') {
            $enable_withdrawal = "yes";
        } else {
            $enable_withdrawal = "no";
        }
        $setting = Setting::where('name', 'enable_withdrawal')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'enable_withdrawal';
        $setting->value = $enable_withdrawal;
        $setting->save();


        if (isset($request['enable_annoc']) and $request['enable_annoc'] == 'on') {
            $enable_annoc = "yes";
        } else {
            $enable_annoc = "no";
        }

        $setting = Setting::where('name', 'enable_annoc')->first();
        if (!$setting) $setting = new Setting();
        $setting->name = 'enable_annoc';
        $setting->value = $enable_annoc;
        $setting->save();

        // $setting = Setting::where('name', 'update_by')->first();
        // if (!$setting) $setting = new Setting();
        // $setting->name = 'update_by';
        // $setting->value = \Auth::user()->tuser()->first_name .  ' ' . \Auth::user()->tuser()->last_name;
        // $setting->save();

        return redirect()->back()
            ->with('message', 'Action Sucessful');
    }


    //Add withdrawal and deposit method
    public function addwdmethod(Request $request)
    {
        $countries = implode(',', $request->countries);

        // upload the logo
        $strtxt = $this->generate_string(6);
        $logoname = '';
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $logoname = $strtxt . $file->getClientOriginalName();
            $path = $file->storeAs('public/photos/logos', $logoname);
        }

        $method = new Wdmethod();
        $method->name = $request->name;
        $method->logo = $logoname;
        $method->setting_key = $request->setting_key;
        $method->exchange_symbol = $request->exchange_symbol;
        $method->minimum = $request->minimum;
        $method->maximum = $request->maximum;
        $method->charges_fixed = $request->charges_fixed;
        $method->charges_percentage = $request->charges_percentage;
        $method->duration = $request->duration;
        $method->country_ids = $countries;
        $method->type = $request->type;
        $method->status = $request->status;
        $method->details = $request->details;
        $method->save();

        $method->logo = $logoname;
        $method->save();

        return redirect()->back()->with('message', 'Method added successful!');
    }


    //Update withdrawal and deposit method
    public function updatewdmethod(Request $request)
    {
        $countries = implode(',', $request->countries);
        $method = Wdmethod::find($request->id);

        // upload the logo
        $strtxt = $this->generate_string(6);
        $logoname = $method->logo;
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $logoname = $strtxt . $file->getClientOriginalName();
            $path = $file->storeAs('public/photos/logos', $logoname);
        }

        $method->update([
            'name' => $request->name,
            'logo' => $logoname,
            'setting_key' => $request->setting_key,
            'exchange_symbol' => $request->exchange_symbol,
            'minimum' => $request->minimum,
            'maximum' => $request->maximum,
            'charges_fixed' => $request->charges_fixed,
            'country_ids' => $countries,
            'charges_percentage' => $request->charges_percentage,
            'duration' => $request->duration,
            'type' => $request->type,
            'status' => $request->status,
            'details' => $request->details,
        ]);

        $method->logo = $logoname;
        $method->save();

        return redirect()->back()
            ->with('message', 'Action Successful');
    }


    // delete withdrawal and deposit method
    public function deletewdmethod($id)
    {
        Wdmethod::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Withdrawal method deleted successful!');
    }


    // save Setttings to DB
    public function updatesettings(Request $request)
    {

        if ($request->withdrawal_option) {
            $setting = Setting::where('name', 'withdrawal_option')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'withdrawal_option';
            $setting->value = $request->withdrawal_option;
            $setting->save();
        }

        if ($request->payment_mode) {
            $setting = Setting::where('name', 'payment_mode')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'payment_mode';
            $setting->value = $request['payment_mode1'] . $request['payment_mode2'] .
                $request['payment_mode3'] . $request['payment_mode4'] . $request['payment_mode5'] . $request['payment_mode6'] . $request['payment_mode7'];
            $setting->save();
        }

        // bank 1
        if ($request->bank_name) {
            $setting = Setting::where('name', 'bank_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bank_name';
            $setting->value = $request->bank_name;
            $setting->save();
        }

        if ($request->bank_address) {
            $setting = Setting::where('name', 'bank_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bank_address';
            $setting->value = $request->bank_address;
            $setting->save();
        }

        if ($request->swift_code) {
            $setting = Setting::where('name', 'swift_code')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'swift_code';
            $setting->value = $request->swift_code;
            $setting->save();
        }

        if ($request->account_name) {
            $setting = Setting::where('name', 'account_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'account_name';
            $setting->value = $request->account_name;
            $setting->save();
        }

        if ($request->account_number) {
            $setting = Setting::where('name', 'account_number')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'account_number';
            $setting->value = $request->account_number;
            $setting->save();
        }

        // bank 2
        if ($request->bank2_name) {
            $setting = Setting::where('name', 'bank2_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bank2_name';
            $setting->value = $request->bank2_name;
            $setting->save();
        }

        if ($request->bank2_address) {
            $setting = Setting::where('name', 'bank2_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bank2_address';
            $setting->value = $request->bank2_address;
            $setting->save();
        }

        if ($request->swift2_code) {
            $setting = Setting::where('name', 'swift2_code')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'swift2_code';
            $setting->value = $request->swift2_code;
            $setting->save();
        }

        if ($request->account2_name) {
            $setting = Setting::where('name', 'account2_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'account2_name';
            $setting->value = $request->account2_name;
            $setting->save();
        }

        if ($request->account2_number) {
            $setting = Setting::where('name', 'account2_number')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'account2_number';
            $setting->value = $request->account2_number;
            $setting->save();
        }

        if ($request->btc_address) {
            $setting = Setting::where('name', 'btc_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'btc_address';
            $setting->value = $request->btc_address;
            $setting->save();
        }

        if ($request->bch_address) {
            $setting = Setting::where('name', 'bch_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bch_address';
            $setting->value = $request->bch_address;
            $setting->save();
        }

        if ($request->ltc_address) {
            $setting = Setting::where('name', 'ltc_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'ltc_address';
            $setting->value = $request->ltc_address;
            $setting->save();
        }

        if ($request->eth_address) {
            $setting = Setting::where('name', 'eth_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'eth_address';
            $setting->value = $request->eth_address;
            $setting->save();
        }

        if ($request->xrp_address) {
            $setting = Setting::where('name', 'xrp_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'xrp_address';
            $setting->value = $request->xrp_address;
            $setting->save();
        }

        if ($request->usdt_address) {
            $setting = Setting::where('name', 'usdt_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'usdt_address';
            $setting->value = $request->usdt_address;
            $setting->save();
        }

        if ($request->usdc_address) {
            $setting = Setting::where('name', 'usdc_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'usdc_address';
            $setting->value = $request->usdc_address;
            $setting->save();
        }

        if ($request->bnb_address) {
            $setting = Setting::where('name', 'bnb_address')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'bnb_address';
            $setting->value = $request->bnb_address;
            $setting->save();
        }

        if ($request->interac_name) {
            $setting = Setting::where('name', 'interac_name')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_name';
            $setting->value = $request->interac_name;
            $setting->save();
        }

        if ($request->interac_email) {
            $setting = Setting::where('name', 'interac_email')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_email';
            $setting->value = $request->interac_email;
            $setting->save();
        }

        if ($request->interac_phone) {
            $setting = Setting::where('name', 'interac_phone')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_phone';
            $setting->value = $request->interac_phone;
            $setting->save();
        }

        if ($request->interac_message) {
            $setting = Setting::where('name', 'interac_message')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_message';
            $setting->value = $request->interac_message;
            $setting->save();
        }

        if ($request->interac_question) {
            $setting = Setting::where('name', 'interac_question')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_question';
            $setting->value = $request->interac_question;
            $setting->save();
        }

        if ($request->interac_answer) {
            $setting = Setting::where('name', 'interac_answer')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'interac_answer';
            $setting->value = $request->interac_answer;
            $setting->save();
        }

        if ($request->s_s_k) {
            $setting = Setting::where('name', 's_s_k')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 's_s_k';
            $setting->value = $request->s_s_k;
            $setting->save();
        }

        if ($request->s_p_k) {
            $setting = Setting::where('name', 's_p_k')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 's_p_k';
            $setting->value = $request->s_p_k;
            $setting->save();
        }

        if ($request->pp_ci) {
            $setting = Setting::where('name', 'pp_ci')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'pp_ci';
            $setting->value = $request->pp_ci;
            $setting->save();
        }

        if ($request->pp_cs) {
            $setting = Setting::where('name', 'pp_cs')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'pp_cs';
            $setting->value = $request->pp_cs;
            $setting->save();
        }

        if ($request->min_dw) {
            $setting = Setting::where('name', 'min_dw')->first();
            if (!$setting) $setting = new Setting();
            $setting->name = 'min_dw';
            $setting->value = $request->min_dw;
            $setting->save();
        }

        // $setting = Setting::where('name', 'update_by')->first();
        // if (!$setting) $setting = new Setting();
        // $setting->name = 'update_by';
        // $setting->value = Auth::user()->tuser()->first_name .  ' ' . Auth::user()->tuser()->last_name;
        // $setting->save();

        return redirect()->back()
            ->with('message', 'Action Sucessful');
    }
}