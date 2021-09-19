@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset( $role ) ? 'Role edit' : 'New Role' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset( $role ) ? 'Role edit' : 'New Role' }}</li>
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
                        <h3 class="card-title">{{ isset( $role ) ? $role->name : 'New Role' }}</h3>

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
                        <form action="{{ isset( $role ) ? route('admin.roles.update', $role) : route('admin.roles.store') }}" method="POST">
                            @csrf
                            @if( isset( $role ) )
                                @method('PUT')
                            @endif
                            @include('admin.partials.error-messages')
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success px-5">{{ isset( $role ) ? 'Update' : 'Create' }}</button>
                                    @if( isset( $role ) )
                                    @can('role_show')
                                        <a href="{{ route('admin.roles.show', $role) }}" role="button" class="btn btn-info px-5">View</a>
                                    @endcan
                                    @endif
                                    @can('role_access')
                                        <a href="{{ route('admin.roles.index') }}" role="button" class="btn btn-primary px-5">List</a>
                                    @endcan
                                    @if( isset( $role ) )
                                    @can('role_delete')
                                        <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.roles.destroy', $role) }}', '{{ route('admin.roles.index') }}', 'Role: {{ $role->name }}')">Delete</a>
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
