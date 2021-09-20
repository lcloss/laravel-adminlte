@extends('admin.layouts.app')
@section('content')
    <x-views.edit-view
        title="Permissions" title-singular="Permission"
        object="permissions" object-singular="permission"
        :model="$permission ?? null" :ref="$permission->name">

        <div class="row">
            <x-forms.input-text
                name="name"
                type="name"
                label="Name"
                groupClass="col-md-6"
                :value="old('name', $permission->name ?? '')"
                placeholder="Permission Name"
                required="true"
            ></x-forms.input-text>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Roles</label>
                    @foreach( $roles as $i => $value )
                        <div class="form-check">
                            @if( isset( $permission ) )
                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}" @if( $permission->roles->contains( $i ) ) checked="checked" @endif>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}">
                            @endif
                            <label class="form-check-label">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </x-views.edit-view>
@endsection
