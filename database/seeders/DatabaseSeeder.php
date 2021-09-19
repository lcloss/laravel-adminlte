<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TenantSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        $adminRole = Role::where('name', 'Administrators')->first();
        $userRole = Role::where('name', 'Users')->first();
        $managerRole = Role::where('name', 'Managers')->first();

        // Assign all permissions to Administrators
        $permissions = array_values( Permission::pluck('id')->toArray() );
        $adminRole->permissions()->sync( $permissions );

        // Assign Managers permissions
        $objects = [
        ];
        $actions = ['access', 'create', 'edit', 'delete', 'show'];
        $menu_access = [
            'dashboard',
        ];
        // For objects
        foreach( $objects as $object ) {
            foreach( $actions as $action ) {
                $permission_name = $object . '_' . $action;
                $permission = Permission::where('name', $permission_name)->first();
                $managerRole->permissions()->attach($permission->id);
            }
        }
        // For menu access
        foreach( $menu_access as $menu ) {
            $permission_name = $menu . '_management_access';
            $permission = Permission::where('name', $permission_name)->first();
            $managerRole->permissions()->attach($permission->id);
        }

        // Assign Adminsitrator to 1st User
        $user = User::where('id', 1)->first();
        $user->roles()->attach($adminRole->id);

        // Assign User role to 2nd User
        $user = User::where('id', 2)->first();
        $user->roles()->attach($userRole->id);

        $users = User::where('id', '>', 1)->get();
        foreach( $users as $user ) {
            $user->update([
                'tenant_id' => 1
            ]);
        }

    }
}
