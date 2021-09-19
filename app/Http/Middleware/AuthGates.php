<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = \Auth::user();

        if ($user) {
            // $roles            = Role::with('permissions')->get();
            $roles               = $user->roles()->with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->name][] = $role->id;
                }
            }

            foreach ($permissionsArray as $name => $roles_id) {
                Gate::define($name, function ($user) use ($name, $roles_id) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles_id)) > 0;
                });
            }
        }

        return $next($request);
    }
}
