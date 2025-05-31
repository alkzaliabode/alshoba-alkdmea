<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TaskUserPermissionsSeeder extends Seeder
{
    public function run()
    {
        $role = Role::where('name', 'tasks-user')->where('guard_name', 'web')->first();

        $permissions = [
            // لمهام المنشآت الصحية
            'view_any_sanitationfacilitytask',
            'view_sanitationfacilitytask',
            'create_sanitationfacilitytask',
            'update_sanitationfacilitytask',
            // لمهام النظافة العامة
            'view_any_generalcleaningtask',
            'view_generalcleaningtask',
            'create_generalcleaningtask',
            'update_generalcleaningtask',
         ];

        foreach ($permissions as $perm) {
            $permission = Permission::where('name', $perm)->where('guard_name', 'web')->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }
    }

}