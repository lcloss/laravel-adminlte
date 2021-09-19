<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
   public function index(): View
   {
       abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $users = User::with(['roles'])->paginate(config('constants.pagination.default_items'));;

       return view('admin.users.index', compact('users'));
   }

   public function create(): View
   {
       abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $tenants = Tenant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
       $roles = Role::pluck('name', 'id');
       $statuses = User::getStatuses();

       return view('admin.users.edit', compact('tenants', 'roles', 'statuses'));
   }

   public function store(StoreUserRequest $request): RedirectResponse
   {
       abort_if(Gate::denies('users_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $user = User::create($request->all());
       $user->roles()->sync($request->input('roles', []));

       return redirect()->route('admin.users.index');
   }

   public function edit(User $user): View
   {
       abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $tenants = Tenant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
       $roles = Role::pluck('name', 'id');
       $statuses = User::getStatuses();

       $user->load('roles');

       return view('admin.users.edit', compact('roles', 'tenants', 'user', 'statuses'));
   }

   public function update(UpdateUserRequest $request, User $user): RedirectResponse
   {
       if( !isset( $request->verified ) ) {
           $request->merge(['verified' => false]);
       }
       if( !isset( $request->approved ) ) {
           $request->merge(['approved' => false]);
       }
       $this->checkUserApproval( $user, $request );

       $user->update($request->all());
       $user->roles()->sync($request->input('roles', []));

       return redirect()->route('admin.users.index');
   }

    public function show(User $user): View
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
       abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $user->delete();

       return back();
    }

    public function checkUserApproval( $user, $request )
    {
        /**
         * If user is approved and it's tenant is pending, than, activate also tenant.
         */
        if( !$user->approved && $request->approved && $user->getRawOriginal('status') == 'P' && $request->status == 'A' ) {
            if ( !is_null( $user->tenant_id ) ) {
                $tenant = Tenant::findOrFail( $user->tenant_id );
                if ( count( $tenant->users()->where('status', 'P')->get() ?? [] ) == 1 && $tenant->getRawOriginal('status') == 'P' ) {
                    $tenant->update(['status' => 'A']);

                    $info_messages = [
                        'Tenant is now active.'
                    ];
                    session()->flash('alert-info', $info_messages);
                }
            }
        }
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
