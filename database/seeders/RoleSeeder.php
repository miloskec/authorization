<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
        Permission::create(['name' => 'profile.show']);
        Permission::create(['name' => 'admin.panel']);

        $adminRole->givePermissionTo('profile.show');
        $adminRole->givePermissionTo('admin.panel');

        $userRole->givePermissionTo('profile.show');

        /*
        // Assign roles to users
        $adminUser = User::find(1); // Admin user
        $adminUser->assignRole('admin');

        $normalUser = User::find(2); // Normal user
        $normalUser->assignRole('user');
        */
    }
}
