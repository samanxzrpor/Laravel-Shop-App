<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeRoles();
        $this->storePermissions();

        $this->setPermissions();
    }

    private function storeRoles()
    {
        $DbRoles = Role::all();
        $roles = config('permission.roles');

        if ($DbRoles->count() < 1 ) {
            foreach ($roles as $role) {
                Role::create(['name' => $role]);
            }
        }
    }

    private function storePermissions()
    {
        $DbPermissions = Permission::all();
        $permissions = config('permission.permissions');

        if ( $DbPermissions->count() < 1) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
    }

    private function setPermissions()
    {
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $superAdmin->givePermissionTo('All Managements');

        $admin = Role::where('name', 'Admin')->first();
        $admin->givePermissionTo('Product Management');
        $admin->givePermissionTo('Blog Management');
        $admin->givePermissionTo('Order Management');
        $admin->givePermissionTo('Categories Management');
    }
}
