@extends('admin.layouts.app')
@section('content')
    <x-views.show-view
        title="Users" title-singular="User"
        object="users" object-singular="user"
        :model="$user" :ref="$user->name">

        <div class="row">
            <x-show-field colClass="col-md-6" label="Tenant">{{ $user->tenant->name ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-md-6" label="Name">{{ $user->name ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-md-6" label="Email">{{ $user->email ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Status">{{ $user->status ?? ' ' }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Approved">{{ $user->approved ? 'Yes' : 'No' }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Verified">{{ $user->verified ? 'Yes' : 'No' }}</x-show-field>
            <x-show-field colClass="col-md-3" label="Roles">
                @foreach( $user->roles as $role )
                    <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                @endforeach
            </x-show-field>
            <x-show-field colClass="col-md-3" label="Tokens">
                @foreach( $user->tokens as $token )
                    {{--                    <span class="badge badge-primary">{{ $role->name ?? '' }}</span>--}}
                    {{ $token }}
                @endforeach
            </x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $user->created_at }}</x-show-field>
            <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $user->updated_at }}</x-show-field>
        </div>

    </x-views.show-view>
@endsection
