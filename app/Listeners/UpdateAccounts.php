<?php

namespace App\Listeners;

use Exception;

use App\Models\Trader7;

use App\Libraries\MobiusTrader;
use App\Libraries\MobiusTrader\MtClient;


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

}