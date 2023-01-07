<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default user
        DB::table('users')->insert([
            'name' => 'John',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'support@monetamarket.ca',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('SecreT12345'),
            'account_type' => '1',
            'ref_by' => '1',
            'address' => "Makepe",
            'town' => 'Buea',
            'state' => 'South West',
            'zip_code' => '063',
            'country_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // default admin
        $admin = DB::table('admins')->insert([
            'firstName' => 'Admin',
            'lastName' => 'Sky Gold Markets',
            'password' => Hash::make('SecreT12345'),
            'phone' => '+237679286569',
            'email' => 'admin@monetamarket.ca',
            //'email' => 'wisdomcamille@gmail.com',
            'acnt_type_active' => 'active',
            'dashboard_style' => "dark",
            'status' => 'active',
            'type' => 'Super Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
