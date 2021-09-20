@extends('admin.layouts.app')
@section('content')
    <x-views.list-view
        title="Roles" title-singular="Role"
        object="roles" object-singular="role"
        :collection="$roles">

        <x-slot name="header">
            <th style="width: 1%">
                #
            </th>
            <th style="width: 30%">
                Role Name
            </th>
            <th style="width: 49%">
                Access
            </th>
        </x-slot>

        <x-slot name="data">
            @foreach( $roles as $role )
                <tr>
                    <td>
                        {{ $role->id }}
                    </td>
                    <td>
                        {{ $role->name ?? '' }}
                    </td>
                    <td>
                        @foreach( $role->permissions as $permission )
                            <span class="badge badge-primary">{{ $permission->name ?? '' }}</span>
                        @endforeach
                    </td>
                    <x-row-actions object="roles" object-singular="role" :model="$role" title="Role" :ref="$role->name"></x-row-actions>
                </tr>
            @endforeach
        </x-slot>
    </x-views.list-view>
@endsection
