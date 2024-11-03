<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions array
        $permissions = [
            ['name' => 'manage-products', 'guard_name' => 'web'],
            ['name' => 'view-orders', 'guard_name' => 'web'],
            ['name' => 'fulfill-orders', 'guard_name' => 'web'],
            ['name' => 'manage-content', 'guard_name' => 'web'],
            ['name' => 'manage-users', 'guard_name' => 'web'],
            ['name' => 'manage-marketing', 'guard_name' => 'web'],
            ['name' => 'view-products', 'guard_name' => 'web'],
            ['name' => 'add-to-cart', 'guard_name' => 'web'],
            ['name' => 'view-cart', 'guard_name' => 'web'],
            ['name' => 'checkout', 'guard_name' => 'web'],
            ['name' => 'view-order-history', 'guard_name' => 'web'],
            ['name' => 'view-order-details', 'guard_name' => 'web'],
            ['name' => 'manage-account', 'guard_name' => 'web'],
            ['name' => 'update-profile', 'guard_name' => 'web'],
            ['name' => 'change-password', 'guard_name' => 'web'],
        ];

        // Insert permissions into the database
        // Permission::insert($permissions);

        // Roles array
        $roles = [
            'administrator' => [],


            'customer' => [],
            'affiliate'=>[],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
            // $role->syncPermissions($rolePermissions);
        }










        // Define the roles to assign
        $roles = [
            'administrator',
            'content_manager',
            'order_manager',
            'customer_service_rep'
        ];

        // Fetch all users
        $users = User::all();
        $i = 1;
        foreach ($users as $user) {
            if ($i == 1) {
                $user->assignRole('administrator');
            } else {
                $user->assignRole('customer');
            }
            $i++;
        }
    }
}
