<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'add-books',
            'delete-books',
            'update-books',
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists to avoid duplication
            $existingPermission = Permission::where('name', $permission)->where('guard_name', 'api')->first();

            if (!$existingPermission) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }
    }

}
