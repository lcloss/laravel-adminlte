@extends('admin.layouts.app')
@section('content')
    <x-views.list-view
        title="Users" title-singular="User"
        object="users" object-singular="user"
        :collection="$users">

        <x-slot name="header">
            <th style="width: 1%">
                #
            </th>
            @if( Auth::user()->isAdmin )
                <th style="width: 16%">
                    Tenant Name
                </th>
                <th style="width: 20%">
                    User Name
                </th>
            @else
                <th style="width: 36%">
                    User Name
                </th>
            @endif
            <th style="width: 16%">
                Email
            </th>
            <th style="width: 10%">
                User Roles
            </th>
            <th style="width: 5%">
                Verified?
            </th>
            <th style="width: 5%">
                Approved?
            </th>
            <th style="width: 8%" class="text-center">
                Status
            </th>
        </x-slot>

        <x-slot name="data">
            @foreach( $users as $user )
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    @if( Auth::user()->isAdmin )
                        <td>
                            {{ $user->tenant->name ?? '' }}
                        </td>
                    @endif
                    <td>
                        {{ $user->name ?? '' }}
                    </td>
                    <td>
                        {{ $user->email ?? '' }}
                    </td>
                    <td>
                        @foreach( $user->roles as $role )
                            <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                        @endforeach
                    </td>
                    <td>
                        {{ $user->verified ? __('global.yes') : __('global.no') }}
                    </td>
                    <td>
                        {{ $user->approved ? __('global.yes') : __('global.no') }}
                    </td>
                    <td class="text-center">
                        @switch( $user->getRawOriginal('status') )
                            @case('P')
                            <span class="badge badge-warning">{{ $user->status }}</span>
                            @break

                            @case('A')
                            <span class="badge badge-success">{{ $user->status }}</span>
                            @break

                            @case('S')
                            <span class="badge badge-secondary">{{ $user->status }}</span>
                            @break

                            @case('I')
                            <span class="badge badge-danger">{{ $user->status }}</span>
                            @break

                            @default
                            <span class="badge badge-default">{{ $user->status }}</span>
                            @break
                        @endswitch
                    </td>
                    <x-row-actions object="users" object-singular="user" :model="$user" title="User" :ref="$user->name"></x-row-actions>
                </tr>
            @endforeach
        </x-slot>
    </x-views.list-view>
@endsection
