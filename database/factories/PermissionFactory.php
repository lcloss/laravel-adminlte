<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $objects = ['users', 'roles', 'permissions', 'posts', 'pages', 'menus'];
        $actions = ['list', 'view', 'create', 'edit', 'delete'];
        $permission = array_rand($objects, 1) . '_' . array_rand($actions, 1);

        return [
            'title' => $permission
        ];
    }
}
