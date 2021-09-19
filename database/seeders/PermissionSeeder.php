<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = [
            'user', 'role', 'permission', 'tenant',
        ];
        $actions = ['access', 'create', 'edit', 'delete', 'show'];

        foreach( $objects as $object ) {
            foreach( $actions as $action ) {
                $data = [
                    'name'  => $object . '_' . $action
                ];
                Permission::create($data);
            }
        }

        $menu_access = [
            'dashboard', 'user',
        ];
        foreach( $menu_access as $access ) {
            $data = [
                'name' => $access . '_management_access'
            ];
            Permission::create($data);
        }
    }
}
