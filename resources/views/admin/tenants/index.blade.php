@extends('admin.layouts.app')
@section('content')
    <x-views.list-view
        title="Tenants" title-singular="Tenant"
        object="tenants" object-singular="tenant"
        :collection="$tenants">

        <x-slot name="header">
            <th style="width: 1%">
                #
            </th>
            <th style="width: 71%">
                Tenant Name
            </th>
            <th style="width: 8%" class="text-center">
                Status
            </th>
        </x-slot>

        <x-slot name="data">
            @foreach( $tenants as $tenant )
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>{{ $tenant->name ?? '' }}</td>
                    <td class="text-center">
                        @switch( $tenant->getRawOriginal('status') )
                            @case('P')
                            <span class="badge badge-warning">{{ $tenant->status }}</span>
                            @break

                            @case('A')
                            <span class="badge badge-success">{{ $tenant->status }}</span>
                            @break

                            @case('S')
                            <span class="badge badge-secondary">{{ $tenant->status }}</span>
                            @break

                            @case('I')
                            <span class="badge badge-danger">{{ $tenant->status }}</span>
                            @break

                            @default
                            <span class="badge badge-default">{{ $tenant->status }}</span>
                            @break
                        @endswitch
                    </td>
                    <x-row-actions object="tenants" object-singular="tenant" :model="$tenant" title="Tenant" :ref="$tenant->name"></x-row-actions>
                </tr>
            @endforeach
        </x-slot>
    </x-views.list-view>
@endsection
