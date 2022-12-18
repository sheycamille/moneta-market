<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Trader7;
use App\Models\TpTransaction;
use App\Models\Withdrawal;

use App\Libraries\MobiusTrader;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Skip enter account details
    public function skip_account(Request $request)
    {
        $request->session()->put('skip_account', 'skip account');
        return redirect()->route('dashboard');
    }

    // Controller self ref issue
    public function ref(Request $request, $id)
    {
        if (isset($id)) {
            $request->session()->flush();
            if (count(User::where('id', $id)->first()) == 1) {
                $request->session()->put('ref_by', $id);
            }
            return redirect()->route('register');
        }
    }

    public function referuser()
    {
        return view('includes.referuser')->with(array(
            'title' => 'Refer user',
        ));
    }

    public function checkdate()
    {
        $dt = Carbon::Now();

        if ($dt->isWeekday()) {
            return "This is a week day";
        } else {
            return "Today is Weekend";
        }
    }

    protected function generate_string($strength = 16, $input = null)
    {
        if ($input == null)
            $input = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    protected function performTransaction($cur, $actNum, $amt, $paySysCode, $purse, $type, $account='balance')
    {
        $m7 = new MobiusTrader(config('mobius'));

        $resp = ['status' => false];
        $amt = (int)$m7->deposit_to_int($cur, $amt);
        $actNum = (int)$actNum;

        if($type == 'deposit') {
            if($account == 'balance')
                $resp = $m7->balance_add($actNum, $amt, $purse, $paySysCode);
            elseif($account == 'credit')
                $resp = $m7->credit_add($actNum, $amt, $purse, $paySysCode);
            elseif($account == 'bonus')
                $resp = $m7->bonus_add($actNum, $amt, $purse, $paySysCode);
        } else {
            $resp = $m7->funds_withdraw($cur, $actNum, -$amt, $paySysCode, $purse);
        }

        return $resp;
    }

    protected function saveRecord($user_id, $t7_id, $method, $amt, $type, $status, $proof = null)
    {
        if ($type == 'Deposit') {
            $record = new Deposit();
        } elseif ($type == 'Withdrawal') {
            $record = new Withdrawal();
        }

        $record->amount = $amt;
        $record->payment_mode = $method;
        $record->status = $status;
        if ($proof != NUll)
            $record->proof = $proof;
        $record->account_id = $t7_id;
        $record->user = $user_id;
        $record->save();

        return;
    }

    protected function saveTransaction($user_id, $amt, $purpose, $type)
    {
        $user = Auth::user();
        // save transaction
        TpTransaction::create([
            'user' => $user_id,
            'purpose' => $purpose,
            'amount' => $amt,
            'type' => $type,
        ]);
    }

    protected function updateaccounts($user)
    {
        // initialize the Trader7 m7
        $m7 = new MobiusTrader(config('mobius'));

        // Get user Trader7 accounts
        $accs = $user->accounts();

        $acc_numbers = $accs->pluck('number')->all();

        try {
            $resp = $m7->money_info($acc_numbers);
            if(is_string($resp)) return ['status' => false, 'msg' => 'An error occurred, contact support'];
            foreach($resp as $acc_num => $money_info) {
                Trader7::where('number', $acc_num)
                    ->update([
                        'balance' => $m7->deposit_from_int('USD', $money_info['Balance']),
                        'bonus' => $m7->deposit_from_int('USD', $money_info['Bonus']),
                        'credit' => $m7->deposit_from_int('USD', $money_info['Credit']),
                        'currency_id' => $money_info['CurrencyId'],
                        'currency' => $money_info['Currency']
                    ]);
            }
            return ['status' => true, 'data' => $resp];
        } catch (Exception $e) {
            return ['status' => false, 'msg' => 'An error occurred, contact support'];
        }
    }

    protected function setMobiusPassword($acc_id, $login, $password)
    {
        $m7 = new MobiusTrader(config('mobius'));

        // set the password
        $resp = $m7->password_set($acc_id, $login, $password);
        return $resp;
    }

    protected function fetchAccountNumbers($acc_id)
    {
        $m7 = new MobiusTrader(config('mobius'));

        // set the password
        $resp = $m7->get_account_numbers((int)$acc_id);
        return $resp;
    }
}