@extends('admin.layouts.app')
@section('content')
    <x-views.show-view
        title="Roles" title-singular="Role"
        object="roles" object-singular="role"
        :model="$role" :ref="$role->name">

        <div class="row">
            <x-show-field colClass="col-md-6" label="Role">{{ $role->name ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-md-6" label="Roles">
                @foreach( $role->permissions as $permission )
                    <span class="badge badge-primary">{{ $permission->name ?? '' }}</span>
                @endforeach
            </x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $role->created_at }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $role->updated_at }}</x-show-field>
        </div>

    </x-views.show-view>
@endsection
