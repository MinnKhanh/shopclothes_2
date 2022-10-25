<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->insert([[
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ], [
            'name' => 'customer',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ], [
            'name' => 'manager',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]]);
        DB::table('permissions')->insert([[
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ], [
            'name' => 'Customer',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ], [
            'name' => 'Manager',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]]);
        // dd(DB::table('roles')->where('name', 'admin')->first());
        Role::where('name', 'admin')->first()->givePermissionTo('Admin');
        Role::where('name', 'customer')->first()->givePermissionTo('Customer');
        Role::where('name', 'manager')->first()->givePermissionTo('Manager');
    }
}
