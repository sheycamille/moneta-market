<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'madmin-list',
            'madmin-create',
            'madmin-edit',
            'madmin-delete',
            'madmin-block',
            'mrole-list',
            'mrole-create',
            'mrole-edit',
            'mrole-delete',
            'mperm-list',
            'mperm-create',
            'mperm-edit',
            'mperm-delete',
            'muser-list',
            'muser-create',
            'muser-edit',
            'muser-delete',
            'muser-messageall',
            'muser-block',
            'muser-access-wallet',
            'muser-credit-debit',
            'muser-access-account',
            'mkyc-list',
            'mkyc-validate',
            'mdeposit-list',
            'mdeposit-process',
            'mwithdrawal-list',
            'mwithdrawal-process',
            'msetting-list',
            'msetting-create',
            'msetting-edit',
            'msetting-delete',
            'mftd-list',
            'macctype-list',
            'macctype-create',
            'macctype-edit',
            'macctype-delete,',
            'system-reports',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}