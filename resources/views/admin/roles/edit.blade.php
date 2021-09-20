@extends('admin.layouts.app')
@section('content')
    <x-views.edit-view
        title="Roles" title-singular="Role"
        object="roles" object-singular="role"
        :model="$role ?? null" :ref="$role->name ?? ''">

        <div class="row">
            <x-forms.input-text
                name="name"
                type="name"
                label="Name"
                groupClass="col-md-6"
                :value="old('name', $role->name ?? '')"
                placeholder="Role Name"
                required="true"
            ></x-forms.input-text>
        </div>
        <div class="row">
            <label>Permissions</label>
        </div>
        <div class="row">
            @foreach( $permissions_group as $group => $accesses )
                <div class="col mt-3 my-3" style="min-height: 150px;">
                    <h6>{{ $group }}</h6>
                    @foreach( $accesses as $access => $id )
                        <div class="form-check">
                            @if( isset( $role ) )
                                <input class="form-check-input permission-checkbox" type="checkbox" value="{{ $id }}" name="permissions[]" id="permission-{{ $id }}" @if( $role->permissions->contains( $id ) ) checked="checked" @endif>
                            @else
                                <input class="form-check-input permission-checkbox" type="checkbox" value="{{ $id }}" name="permissions[]" id="permission-{{ $id }}">
                            @endif
                            <label class="form-check-label" for="inputAssignRole-{{ $id }}">{{ $access }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <!-- /.row -->

    </x-views.edit-view>
@endsection
