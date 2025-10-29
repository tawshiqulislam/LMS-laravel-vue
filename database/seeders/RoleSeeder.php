<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'instructor']);
        Role::updateOrCreate(['name' => 'organization']);

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $role = Role::where('name', 'admin')->first();
            // permission to admin
            $role->givePermissionTo($permission);
        }

        $permissions = Permission::all()->skip(18)->take(47);

        foreach ($permissions as $permission) {
            $insRole = Role::where('name', 'instructor')->first();
            $orgRole = Role::where('name', 'organization')->first();

            // permission to instructor
            $insRole->givePermissionTo($permission);
            // permission to organization
            $orgRole->givePermissionTo($permission);
        }
    }
}
