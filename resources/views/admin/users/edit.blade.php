@extends('admin.layouts.app')
@section('styles')
    @include('admin.partials.select2Styles')
@endsection
@section('content')
    <x-views.edit-view
        title="Users" title-singular="User"
        object="users" object-singular="user"
        :model="$user ?? null">

        <div class="row">
            @if( Auth::user()->isAdmin )
                <x-forms.input-select
                    name="tenant_id"
                    label="Tenant"
                    groupClass="col-md-6"
                    value="{{ old('tenant_id', $user->tenant_id ?? '') }}"
                    :options="$tenants"
                    required="false"
                ></x-forms.input-select>
            @endif
            <x-forms.input-text
                name="name"
                type="name"
                label="Name"
                groupClass="col-md-6"
                :value="old('name', $user->name ?? '')"
                placeholder="User Name"
                required="true"
            ></x-forms.input-text>
            <x-forms.input-text
                name="email"
                type="email"
                label="Email"
                groupClass="col-md-6"
                :value="old('email', $user->email ?? '')"
                placeholder="User email"
                required="true"
            ></x-forms.input-text>
            <x-forms.input-select
                name="status"
                label="Status"
                groupClass="col-md-3"
                value="{{ isset( $user ) ? old('status', $user->getRawOriginal('status') ) : old('status') }}"
                :options="$statuses"
                required="true"
            ></x-forms.input-select>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Approval</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" value="1" name="approved" id="approved" @if( $user->approved ?? '' ) checked="checked" @endif>
                        <label class="custom-control-label" for="approved">Is approved ?</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" value="1" name="verified" id="verified" @if( $user->verified ?? '' ) checked="checked" @endif>
                        <label class="custom-control-label" for="verified">Is verified ?</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Roles</label>
                    @foreach( $roles as $i => $value )
                        <div class="form-check">
                            @if( isset( $user ) )
                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}" @if( $user->roles->contains( $i ) ) checked="checked" @endif>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}">
                            @endif
                            <label class="form-check-label">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.row -->

    </x-views.edit-view>
@endsection
@section('scripts')
    @include('admin.partials.select2Scripts')
@endsection
