<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
   public function index(): View
   {
       abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $roles = Role::with(['permissions'])->paginate(config('constants.pagination.default_items'));

       return view('admin.roles.index', compact('roles'));
   }

   public function create(): View
   {
       abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $permissions_group = [];
       $permissions = Permission::orderBy('name')->pluck('name', 'id')->toArray();
       foreach( $permissions as $id => $name ) {
           $names = explode( '_', $name );
           $access = array_pop( $names );
           $group = implode( '_', $names );

           if ( !array_key_exists( $group, $permissions_group ) ) {
               $permissions_group[$group] = [];
           }
           if ( !array_key_exists( $access, $permissions_group[$group] ) ) {
               $permissions_group[$group][$access] = $id;
           }
       }


       return view('admin.roles.edit', compact('permissions_group', 'permissions'));
   }

   public function store(StoreRoleRequest $request): RedirectResponse
   {
       $role = Role::create($request->all());
       $role->permissions()->sync($request->input('permissions', []));

       return redirect()->route('admin.roles.index');
   }

   public function edit(Role $role): View
   {
       abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $permissions_group = [];
       $permissions = Permission::orderBy('name')->pluck('name', 'id')->toArray();
       foreach( $permissions as $id => $name ) {
           $names = explode( '_', $name );
           $access = array_pop( $names );
           $group = implode( '_', $names );

           if ( !array_key_exists( $group, $permissions_group ) ) {
               $permissions_group[$group] = [];
           }
           if ( !array_key_exists( $access, $permissions_group[$group] ) ) {
               $permissions_group[$group][$access] = $id;
           }
       }

       $role->load('permissions');

       return view('admin.roles.edit', compact('permissions_group', 'role'));
   }

   public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
   {
       $role->update($request->all());
       $role->permissions()->sync($request->input('permissions', []));

       return redirect()->route('admin.roles.index');
   }

    public function show(Role $role): View
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy(Role $role): RedirectResponse
   {
       abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $role->permissions()->sync([]);
       $role->delete();

       return back();
       // return response()->json('OK');
   }
    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
