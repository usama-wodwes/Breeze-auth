<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Define Permissions
        $permissions = [
            'manage users',
            'view all products',
            'approve products',
            'create product',
            'edit own product',
            'delete own product'
        ];

        // Assign Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Give permissions to roles
        $adminRole->givePermissionTo(['manage users', 'view all products', 'approve products']);
        $userRole->givePermissionTo(['create product', 'edit own product', 'delete own product']);
    }
}
