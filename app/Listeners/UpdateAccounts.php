<?php

namespace App\Listeners;

use Exception;

use App\Models\Trader7;

use App\Libraries\MobiusTrader;


class UpdateAccounts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        // return for admins
        if (strpos(strtolower(get_class($user)), 'admin') > -1)
            return;

        // initialize the Trader7 api
        $m7 = new MobiusTrader();

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

}