@extends('admin.layouts.app')
@section('content')
    <x-views.edit-view
        title="Tenants" title-singular="Tenant"
        object="tenants" object-singular="tenant"
        :model="$tenant ?? null" :ref="$tenant->name ?? ''">

        <div class="row">
            <x-forms.input-text
                name="name"
                type="name"
                label="Name"
                groupClass="col-md-6"
                :value="old('name', $tenant->name ?? '')"
                placeholder="Tenant Name"
                required="true"
            ></x-forms.input-text>
            <x-forms.input-select
                name="status"
                label="Status"
                groupClass="col-md-3"
                value="{{ isset( $tenant ) ? old('status', $tenant->getRawOriginal('status') ) : old('status') }}"
                :options="$statuses"
                required="true"
            ></x-forms.input-select>
        </div>
        <!-- /.row -->

    </x-views.edit-view>
@endsection
