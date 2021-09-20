<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkStorePermissionRequest;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
   public function index(): View
   {
       abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $permissions = Permission::paginate(config('constants.pagination.default_items'));

       return view('admin.permissions.index', compact('permissions'));
   }

   public function create(): View
   {
       abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $roles = Role::pluck('name', 'id');

       return view('admin.permissions.edit', compact('roles'));
   }

   public function store(StorePermissionRequest $request): RedirectResponse
   {
       $permission = Permission::create($request->all());
       $permission->roles()->sync($request->roles);

       return redirect()->route('admin.permissions.index');
   }

   public function edit(Permission $permission): View
   {
       abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $roles = Role::pluck('name', 'id');

       return view('admin.permissions.edit', compact('permission', 'roles'));
   }

   public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
   {
       abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $permission->update($request->all());
       $permission->roles()->sync($request->roles);

       return redirect()->route('admin.permissions.index');
   }

    public function show(Permission $permission): View
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission): RedirectResponse
   {
       abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $permission->roles()->sync([]);
       $permission->delete();

       return back();
   }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

   public function bulkCreate()
   {
       return view('admin.permissions.bulk-create');
   }
   public function bulkStore(BulkStorePermissionRequest $request): RedirectResponse
   {
       $permissions = $request->validated();

       foreach( $permissions['permission'] as $permission )
       {
           $permission = Permission::create($permission);
           $permission->roles()->sync($request->roles);
       }

       return redirect()->route('admin.permissions.index');
   }

   public function bulkDelete(): View
   {
       $permissionsCollection = Permission::orderBy('name')->get();
       $groupCtrl = '';
       $permissions = [];

       foreach( $permissionsCollection as $permission ) {
           $group = explode('_', $permission['name'])[0];
           if ( $group != $groupCtrl ) {
               $permissions[] = $group;
               $groupCtrl = $group;
           }
       }

       return view('admin.permissions.bulk-delete', compact('permissions'));
   }

   public function bulkDestroy(Request $request): RedirectResponse
   {
       $permissions = [];
       $default_permissions = ['list', 'select', 'insert', 'update', 'delete'];

       foreach( $default_permissions as $permission_suffix ) {
           $permissionToDelete = $request->object . '_' . $permission_suffix;
           $permission = Permission::where('name', $permissionToDelete)->first();
           $permission->roles()->detach();
           $permission->delete();
       }

       return redirect()->route('admin.permissions.index');
   }

}
