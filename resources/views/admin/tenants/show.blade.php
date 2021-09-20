@extends('admin.layouts.app')
@section('content')
    <x-views.show-view
        title="Tenants" title-singular="Tenant"
        object="tenants" object-singular="tenant"
        :model="$tenant" :ref="$tenant->name">

        <div class="row">
            <x-show-field colClass="col-md-6" label="Tenant">{{ $tenant->name ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-md-6" label="Users">
                @foreach( $tenant->users as $user )
                    <span class="badge badge-primary">{{ $user->name ?? '' }}</span>
                @endforeach
            </x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $tenant->created_at }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $tenant->updated_at }}</x-show-field>
        </div>

    </x-views.show-view>
@endsection
