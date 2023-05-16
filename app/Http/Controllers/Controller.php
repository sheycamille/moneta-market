<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Trader7;
use App\Models\TpTransaction;
use App\Models\Withdrawal;

use App\Libraries\MobiusTrader;
use App\Libraries\MobiusTrader\MtClient;

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
            $user =  User::find($id);
            if ($user) {
                $request->session()->put('ref_by', $id);
            }
            return redirect()->route('register');
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
        $mobius = new MobiusTrader(config('mobius'));
        $m7 = new MtClient(config('mobius'));

        $resp = ['status' => false];
        $amt = (int)$mobius->deposit_to_int($cur, $amt);
        $actNum = (int)$actNum;

        if($type == 'deposit') {
            $data = array(
                'TradingAccountId' => $actNum,
                'Amount' => $amt,
                'Comment' => $paySysCode . ' | ' . $purse);
            if($account == 'balance')
                $resp = $m7->call('BalanceAdd', $data);
            elseif($account == 'credit')
                $resp = $m7->call('CreditAdd', $data);
            elseif($account == 'bonus')
                $resp = $m7->call('BonusAdd', $data);
        } else {
            $data = array(
                'TradingAccountId' => $actNum,
                'Amount' => -$amt,
                'Comment' => $paySysCode . ' | ' . $purse);
            $resp = $m7->call('BalanceAdd', $data);
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
        $mobius = new MobiusTrader(config('mobius'));
        $m7 = new MtClient(config('mobius'));

        // Get user Trader7 accounts
        $accs = $user->accounts();

        $acc_numbers = $accs->pluck('number')->all();

        try {
            $resp = $m7->call('MoneyInfo', array(
                'TradingAccounts' => (array)$acc_numbers,
                'Currency' => '',
            ));
            if(is_string($resp)) return ['status' => false, 'msg' => 'An error occurred, contact support'];
            foreach($resp['data'] as $acc_num => $money_info) {
                Trader7::where('number', $acc_num)
                    ->update([
                        'balance' => $mobius->deposit_from_int('USD', $money_info['Balance']),
                        'bonus' => $mobius->deposit_from_int('USD', $money_info['Bonus']),
                        'credit' => $mobius->deposit_from_int('USD', $money_info['Credit']),
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
        $m7 = new MtClient(config('mobius'));

        // set the password
        $data = array(
            'ClientId' => (int)$acc_id,
            'Login' => $login,
            'Password' => $password,
            'SessionType' => 0
        );
        $resp = $m7->call('PasswordSet', $data);
        return $resp;
    }


    protected function fetchAccountNumbers($acc_id)
    {
        $m7 = new MtClient(config('mobius'));

        // set the password
        $resp = $m7->call('TradingAccountsGet', array(
            'Id' => (int)$acc_id
        ));
        return $resp;
    }
}