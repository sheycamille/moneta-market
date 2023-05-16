<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Trader7;
use App\Mail\NewNotification;

use App\Libraries\MobiusTrader;
use App\Libraries\MobiusTrader\MtClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;



class T7Controller extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    // serves users demo accounts
    public function demoaccounts()
    {
        $user_id = Auth::user()->id;
        $accounts = Trader7::where('type', MobiusTrader::ACCOUNT_NUMBER_TYPE_DEMO)->where('client_id', $user_id)->get();
        return view('user.demoaccounts', [
            'title' => 'Demo Accounts',
            'accounts' => $accounts
        ]);
    }


    // serves users live accounts
    public function liveaccounts()
    {
        $user = Auth::user();
        $accounts = Trader7::where('type', MobiusTrader::ACCOUNT_NUMBER_TYPE_REAL)->where('client_id', $user->id)->get();

        $m7 = new MobiusTrader(config('mobius'));

        // if($accounts->isEmpty()) {
        //     $accountsData = $this->fetchAccountNumbers($user->account_number);
        //     foreach($accountsData as $data) {
        //         $t7 = new Trader7();
        //         $t7->client_id = $user->id;
        //         $t7->number = $data['Id'];
        //         $t7->name = $data['Name'];
        //         $t7->type = $data['Type'];
        //         $t7->leverage = $data['Leverage'];
        //         $t7->currency = 'USD';
        //         $t7->status = 'active';
        //         $t7->currency_id = $data['CurrencyId'];
        //         $t7->balance = $m7->deposit_to_int('USD', $data['Balance']);
        //         $t7->bonus = $m7->deposit_to_int('USD', $data['Bonus']);
        //         $t7->credit = $m7->deposit_to_int('USD', $data['Credit']);
        //         $t7->save();
        //     }
        // }
        $accounts = Trader7::where('type', MobiusTrader::ACCOUNT_NUMBER_TYPE_REAL)->where('client_id', $user->id)->get();

        return view('user.liveaccounts', [
            'title' => 'Live Accounts',
            'accounts' => $accounts
        ]);
    }


    public function addt7account(Request $request)
    {
        // do validation of input first
        Validator::make($request->all(), [
            'name' => ['required', 'string',],
            'leverage' => ['required', 'string',],
            'type' => ['required', 'string',],
        ])->validate();

        // get logged in user
        // some info will come from their registration
        $user = auth()->user();

        $currency = 'USD';
        $name = $request->name;
        $type = MobiusTrader::ACCOUNT_NUMBER_TYPE_DEMO;
        $leverage = $request->leverage;
        $tags = array($user->account_number.'', date('Y'), $currency);

        if ($request->type !== 'demo') {
            $type = MobiusTrader::ACCOUNT_NUMBER_TYPE_REAL;
        }

        // Trader7 account creation
        $m7 = new MtClient(config('mobius'));
        $data = array(
            'ClientId' => (int)$user->account_number,
            'Leverage' => (int)$leverage,
            'SettingsTemplate' => $currency,
            'DisplayName' => $name,
            'Tags' => $tags,
            'Type' => $type,
        );
        $resp = $m7->call('TradingAccountCreate', $data);
        if ($resp['status'] !== MobiusTrader::STATUS_OK) {
            $request->session()->flash("message", $resp['message']);
            return response(["message" => $resp['message']]);
        }
        $data = $resp['data'];

        // save the detials in the Trader7 detials table
        $t7 = new Trader7();
        $t7->client_id = $user->id;
        $t7->number = $data['Id'];
        $t7->name = $data['DisplayName'];
        $t7->type = $data['Type'];
        $t7->swap_type = $data['SwapType'];
        $t7->loyalty = $data['Loyalty'];
        $t7->leverage = $data['Leverage'];
        $t7->currency = $data['Currency'];
        $t7->balance = $request->balance;
        $t7->status = 'active';
        $t7->is_cheater = $data['IsCheater'];
        $t7->currency_id = $data['CurrencyId'];
        $t7->balance = $data['Balance'];
        $t7->bonus = $data['Bonus'];
        $t7->credit = $data['Credit'];
        $t7->save();

        // do a deposit for demo accounts
        if ($t7->type == MobiusTrader::ACCOUNT_NUMBER_TYPE_DEMO) {
            $this->demotopup($request, $t7->id);
        }

        // send the user an email with the details of the new account
        $this->notifyuser($t7);

        $request->session()->flash("message", "Your new Trader7 account has been created successfully. Check your email for the full account details. We are always at your service!");
        return ["message" => "Your new Trader7 account has been created successfully. Check your email for the full account details. We are always at your service!"];
    }

    public function resett7password()
    {
    }


    public function demotopup(Request $request, $id)
    {
        $t7Acc = Trader7::where('id', $id)->first();

        // update the Trader7 demo server
        $resp = $this->performTransaction($t7Acc->currency, $t7Acc->number, '10000.0', 'MM-DEMO', 'MM-AUTO', 'deposit', 'balance');

        $msg = 'Your Trader7 Demo Account has been successfully topped up with $10k!';

        if($resp['status'] !== MobiusTrader::STATUS_OK) {
            $msg = 'An error occurred, please contact support';
        } else {
            // update the local record
            $t7Acc->balance = (((int)$t7Acc->balance) + 10000);
            $t7Acc->save();
        }

        return redirect()->back()
            ->with('message', $msg);
    }

    protected function notifyuser($t7Acc)
    {
        $user = Auth::user();

        // send verification email
        $site_name = Setting::getValue('site_name');
        $objDemo = new \stdClass();
        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
        $objDemo->message = "\r Hello $name, \r \n " .
            " \r This is to inform you that a new Trader7 Account with details below have successfully registered on $site_name. \r \n " .
            "   \r  Account Number: $t7Acc->number \r \n " .
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Your new Trader7 Account with Moneta Market!";

        Mail::mailer('smtp')->bcc($user->email)->send(new NewNotification($objDemo));
    }


    protected function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}