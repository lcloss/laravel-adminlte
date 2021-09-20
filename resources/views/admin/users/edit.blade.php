@extends('admin.layouts.app')
@section('styles')
    @include('admin.partials.select2Styles')
@endsection
@section('content')
    <x-views.edit-view
        title="Users" title-singular="User"
        object="users" object-singular="user"
        :model="$user ?? null" :ref="$user->name ?? ''">

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
                type="text"
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
            <x-forms.input-text
                name="password"
                type="password"
                label="Password"
                groupClass="col-md-3"
                :value="old('password', '')"
                placeholder=""
                required="false"
            ></x-forms.input-text>
            <x-forms.input-text
                name="password_confirmation"
                type="password"
                label="Confirm password"
                groupClass="col-md-3"
                :value="old('password_confirmation', '')"
                placeholder=""
                required="false"
            ></x-forms.input-text>
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
            @if( isset( $none) )
            <x-forms.input-text
                name="api_token"
                type="text"
                label="Token"
                groupClass="col-md-6"
                value="{{ $user->api_token }}"
                placeholder="API Token"
                required="false"
                disabled="disabled"
            ></x-forms.input-text>
            @endif
            @if( isset( $user ) )
            <div class="col-md-6">
                <div class="form-group">
                    <label for="api_token" class="form-label">Token</label>
                    <div class="input-group">
                        <input type="text" class="form-control  " id="api_token" name="api_token" value="{{ $user->api_token }}" placeholder="API Token" disabled="disabled">
                    </div>
                    <button type="button" class="btn btn-success mt-2" onclick="updateToken('{{ route('admin.users.updatetoken', $user) }}')" >Update token</button>
                </div>
            </div>
            @endif
                @if( isset( $none ))
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn btn-success" onclick="updateToken('{{ route('admin.users.updatetoken', $user) }}', {{ Auth::user()->id }})" >Update token</button>
                </div>
            </div>
                    @endif
        </div>
        <!-- /.row -->

    </x-views.edit-view>
@endsection
@section('scripts')
    @include('admin.partials.select2Scripts')
@endsection
