@extends('admin.layouts.app')
@section('content')
    <x-views.show-view
        title="Permissions" title-singular="Permission"
        object="permissions" object-singular="permission"
        :model="$permission" :ref="$permission->name">

        <div class="row">
            <x-show-field colClass="col-md-6" label="Permission">{{ $permission->name ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-md-6" label="Roles">
                @foreach( $permission->roles as $role )
                    <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                @endforeach
            </x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $permission->created_at }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $permission->updated_at }}</x-show-field>
        </div>

    </x-views.show-view>
@endsection
