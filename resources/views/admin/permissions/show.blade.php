@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Permission Details</li>
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
                    <h3 class="card-title">Permission Details</h3>

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
                    <div class="row">
                        <x-show-field colClass="col-md-6" label="Permission">{{ $permission->name ?? ' ' }}</x-show-field>
                        <x-show-field colClass="col-md-6" label="Roles">
                            @foreach( $permission->roles as $role )
                                <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                            @endforeach
                        </x-show-field>
                        <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $permission->created_at }}</x-show-field>
                        <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $permission->updated_at }}</x-show-field>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            @can('permission_edit')
                                <a href="{{ route('admin.permissions.edit', $permission) }}" permission="button" class="btn btn-info px-5">Edit</a>
                            @endcan
                            @can('permission_access')
                                <a href="{{ route('admin.permissions.index') }}" permission="button" class="btn btn-primary px-5">List</a>
                            @endcan
                            @can('permission_delete')
                                <a href="#" permission="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.permissions.destroy', $permission) }}', '{{ route('admin.permissions.index') }}', 'Permission: {{ $permission->name }}')">Delete</a>
                            @endcan
                        </div>
                    </div>
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
