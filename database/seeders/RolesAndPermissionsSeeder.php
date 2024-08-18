<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view invoices']);
        Permission::create(['name' => 'create invoices']);
        Permission::create(['name' => 'edit invoices']);
        Permission::create(['name' => 'delete invoices']);
        
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage permissions']);
        
        // Create roles and assign permissions
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleAdmin->givePermissionTo([
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage permissions',
        ]);

        $roleCamp = Role::create(['name' => 'Camp']);
        $roleCamp->givePermissionTo([
            'view invoices',
            'create invoices',
        ]);

        $roleSalesSupervisor = Role::create(['name' => 'Sales Supervisor']);
        $roleSalesSupervisor->givePermissionTo([
            'view invoices',
            'edit invoices',
        ]);

        $roleAccounts = Role::create(['name' => 'Accounts']);
        $roleAccounts->givePermissionTo([
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
        ]);

        $roleStaff = Role::create(['name' => 'Staff']);
        $roleStaff->givePermissionTo([
            'view invoices',
        ]);

        $roleKitchen = Role::create(['name' => 'Kitchen']);
        $roleKitchen->givePermissionTo([
            // Add specific permissions here if needed
        ]);
    }
}
