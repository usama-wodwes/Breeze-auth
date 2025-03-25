<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create Permissions
        $permissions = [
            'manage users',
            'approve products',
            'create products',
            'update own products',
            'delete own products',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $adminRole->givePermissionTo(['manage users', 'approve products']);
        $userRole->givePermissionTo(['create products', 'update own products', 'delete own products']);

        // Assign Admin Role to First User
        $admin = User::first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
