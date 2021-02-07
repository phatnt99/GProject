<?php

use App\Enums\PermissionType;
use App\Enums\UserType;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        foreach (PermissionType::toArray() as $display_name => $name) {
            Permission::updateOrCreate(['name' => $name, 'display_name' => Str::singular($display_name), 'guard_name' => 'admin']);
        }

        // Create roles
        foreach (UserType::toArray() as $display_name => $name) {
            if($name == UserType::SUPER_ADMIN || $name == UserType::ADMIN)
                Role::updateOrCreate(['name' => $name, 'display_name' => Str::singular($display_name), 'guard_name' => 'admin']);
            else
                Role::updateOrCreate(['name' => $name, 'display_name' => Str::singular($display_name), 'guard_name' => 'admin']);
        }

        // Give all permission to role super admin
        $role = Role::findByName(UserType::SUPER_ADMIN, 'admin');
        $role->givePermissionTo(Permission::all());

        // Created super admin
        $superadmin = factory(Admin::class)->create(['login_id' => 'superadmin', 'password' => 'password']);
        $superadmin->assignRole($role);
    }
}
