@extends('admin.layouts.app')
@section('content')
    <x-views.list-view
        title="Permissions" title-singular="Permission"
        object="permissions" object-singular="permission"
        :collection="$permissions">

        <x-slot name="header">
            <th style="width: 1%">
                #
            </th>
            <th style="width: 50%">
                Permission Name
            </th>
            <th style="width: 29%">
                Roles
            </th>
        </x-slot>

        <x-slot name="data">
            @foreach( $permissions as $permission )
                <tr>
                    <td>
                        {{ $permission->id }}
                    </td>
                    <td>
                        {{ $permission->name ?? '' }}
                    </td>
                    <td>
                        @foreach( $permission->roles as $role )
                            <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                        @endforeach
                    </td>
                    <x-row-actions object="permissions" object-singular="permission" :model="$permission" title="Permission" :ref="$permission->name"></x-row-actions>
                </tr>
            @endforeach
        </x-slot>
    </x-views.list-view>
@endsection
