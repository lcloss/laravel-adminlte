@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset( $permission ) ? 'Permission edit' : 'New permission' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset( $permission ) ? 'Permission edit' : 'New permission' }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset( $permission ) ? $permission->name : 'New permission' }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ isset( $permission ) ? route('admin.permissions.update', $permission) : route('admin.permissions.store') }}" method="POST">
                            @csrf
                            @if( isset( $permission ) )
                                @method('PUT')
                            @endif
                            @include('admin.partials.error-messages')
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
                                <!-- /.col -->
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success px-5">{{ isset( $permission ) ? 'Update' : 'Create' }}</button>
                                    @if( isset( $permission ) )
                                        @can('permission_show')
                                            <a href="{{ route('admin.permissions.show', $permission) }}" permission="button" class="btn btn-info px-5">View</a>
                                        @endcan
                                    @endif
                                    @can('permission_access')
                                        <a href="{{ route('admin.permissions.index') }}" permission="button" class="btn btn-primary px-5">List</a>
                                    @endcan
                                    @if( isset( $permission ) )
                                        @can('permission_delete')
                                            <a href="#" permission="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.permissions.destroy', $permission) }}', '{{ route('admin.permissions.index') }}', 'Permission: {{ $permission->name }}')">Delete</a>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection
