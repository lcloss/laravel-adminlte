<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TenantController extends Controller
{
   public function index(): View
   {
       abort_if(Gate::denies('tenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $tenants = Tenant::paginate(config('constants.pagination.default_items'));

       return view('admin.tenants.index', compact('tenants'));
   }

   public function create(): View
   {
       abort_if(Gate::denies('tenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $statuses = Tenant::getStatuses();

       return view('admin.tenants.edit', compact('statuses'));
   }

   public function store(StoreTenantRequest $request): RedirectResponse
   {
       abort_if(Gate::denies('tenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       Tenant::create($request->validated());

       return redirect()->route('admin.tenants.index');
   }

   public function show(Tenant $tenant): View
   {
       abort_if(Gate::denies('tenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       return view('admin.tenants.show', compact('tenant'));
   }

   public function edit(Tenant $tenant): View
   {
       abort_if(Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $statuses = Tenant::getStatuses();

       return view('admin.tenants.edit', compact('tenant', 'statuses'));
   }

   public function update(UpdateTenantRequest $request, Tenant $tenant): RedirectResponse
   {
       abort_if(Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $tenant->update($request->validated());

       return redirect()->route('admin.tenants.index');
   }

   public function destroy(Tenant $tenant): RedirectResponse
   {
       abort_if(Gate::denies('tenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $tenant->delete();

       return back();
       // return redirect()->route('admin.tenants.index');
       // return response()->json('OK');
   }

    public function massDestroy(MassDestroyTenantRequest $request)
    {
        Tenant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
