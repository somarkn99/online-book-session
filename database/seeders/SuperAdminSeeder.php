<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'api',
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $user = User::create([
            'user_name' => 'super_admin',
            'name' => 'Super Administrator',
            'phone_number' => '123456789',
            'password' => Hash::make('password'),
            'role_name' => 'SuperAdmin',
        ]);

        $user->assignRole('SuperAdmin');
    }
}
