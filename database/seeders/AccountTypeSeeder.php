<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // beginner account type
        DB::table('account_types')->insert([
            'name' => 'Beginner',
            'cost' => '250',
            'min_deposit' => '250',
            'trading_model' => 'STP',
            'max_trade_size' => '5',
            'min_trade_size' => 0.01,
            'typical_spread' => 1,
            'fx_commission' => 'No',
            'num_fx_pairs' => 71,
            'num_indices_pairs' => 12,
            'num_commodities_pairs' => 5,
            'max_leverage' => '1:500',
            'execution_type' => 'Market Execution',
            'available_instruments' => 'FX, Indices, Commodities, Metals, Crypto, Actions',
        ]);


        // Intermediate account type
        DB::table('account_types')->insert([
            'name' => 'Intermediate',
            'cost' => '20k',
            'min_deposit' => '20000',
            'trading_model' => 'STP',
            'max_trade_size' => '40',
            'min_trade_size' => 0.01,
            'typical_spread' => 0.1,
            'fx_commission' => '3.50USD/EUR per 100,000',
            'num_fx_pairs' => 71,
            'num_indices_pairs' => 12,
            'num_commodities_pairs' => 5,
            'max_leverage' => '1:300',
            'execution_type' => 'Market Execution',
            'available_instruments' => 'FX, Indices, Commodities, Metals',
        ]);


        // Advanced account type
        DB::table('account_types')->insert([
            'name' => 'Advanced',
            'cost' => '50k',
            'min_deposit' => '50000',
            'trading_model' => 'STP',
            'max_trade_size' => '40',
            'min_trade_size' => 0.01,
            'typical_spread' => 0.7,
            'fx_commission' => 'No',
            'num_fx_pairs' => 71,
            'num_indices_pairs' => 12,
            'num_commodities_pairs' => 5,
            'max_leverage' => '1:300',
            'execution_type' => 'Market Execution',
            'available_instruments' => 'FX, Indices, Commodities, Metals',
        ]);


        // Islamic account type
        DB::table('account_types')->insert([
            'name' => 'Islamic',
            'cost' => '50k',
            'active' => false,
            'min_deposit' => '50000',
            'trading_model' => 'STP',
            'max_trade_size' => '40',
            'min_trade_size' => 0.1,
            'typical_spread' => 0.7,
            'fx_commission' => 'No',
            'num_fx_pairs' => 71,
            'num_indices_pairs' => 12,
            'num_commodities_pairs' => 5,
            'max_leverage' => '1:300',
            'execution_type' => 'Market Execution',
            'available_instruments' => 'FX, Indices, Commodities, Metals',
        ]);


        // VIP account type
        DB::table('account_types')->insert([
            'name' => 'VIP',
            'cost' => '100k',
            'min_deposit' => '100000',
            'trading_model' => 'STP',
            'max_trade_size' => 'Unlimited',
            'min_trade_size' => 0.1,
            'typical_spread' => 0.1,
            'fx_commission' => '2.50USD/EUR per 100,000',
            'num_fx_pairs' => 71,
            'num_indices_pairs' => 12,
            'num_commodities_pairs' => 5,
            'max_leverage' => '1:100',
            'execution_type' => 'Market Execution',
            'available_instruments' => 'FX, Indices, Commodities, Metals',
        ]);
    }
}
