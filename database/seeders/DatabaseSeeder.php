<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccountTypeSeeder::class,
            PermissionTableSeeder::class,
            UserSeeder::class,
            UserPermsSeeder::class,
            CountryStateCityTableSeeder::class,
        ]);
    }
}
