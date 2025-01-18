<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'role-permissions.manage', 'guard_name' => 'web'],

            ['name' => 'role.create', 'guard_name' => 'web'],
            ['name' => 'role.manage', 'guard_name' => 'web'],
            ['name' => 'role.store', 'guard_name' => 'web'],
            ['name' => 'role.update', 'guard_name' => 'web'],
            ['name' => 'role.delete', 'guard_name' => 'web'],

            ['name' => 'permission.manage', 'guard_name' => 'web'],
            ['name' => 'permission.create', 'guard_name' => 'web'],
            ['name' => 'permission.update', 'guard_name' => 'web'],
            ['name' => 'permission.delete', 'guard_name' => 'web'],

            ['name' => 'manage-user.manage', 'guard_name' => 'web'],
            ['name' => 'manage-user.create', 'guard_name' => 'web'],
            ['name' => 'manage-user.view', 'guard_name' => 'web'],
            ['name' => 'manage-user.update', 'guard_name' => 'web'],
            ['name' => 'manage-user.delete', 'guard_name' => 'web'],

        ];

        Permission::upsert($permissions, 'name');
    }
}
