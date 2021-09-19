@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role Details</li>
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
                    <h3 class="card-title">Role Details</h3>

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
                        <x-show-field colClass="col-md-6" label="Role">{{ $role->name ?? ' ' }}</x-show-field>
                        <x-show-field colClass="col-md-6" label="Permissions">
                            @foreach( $role->permissions as $permission )
                                <span class="badge badge-primary">{{ $permission->name ?? '' }}</span>
                            @endforeach
                        </x-show-field>
                        <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $role->created_at }}</x-show-field>
                        <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $role->updated_at }}</x-show-field>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            @can('role_edit')
                                <a href="{{ route('admin.roles.edit', $role) }}" role="button" class="btn btn-info px-5">Edit</a>
                            @endcan
                            @can('role_access')
                                <a href="{{ route('admin.roles.index') }}" role="button" class="btn btn-primary px-5">List</a>
                            @endcan
                            @can('role_delete')
                                <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.roles.destroy', $role) }}', '{{ route('admin.roles.index') }}', 'Role: {{ $role->name }}')">Delete</a>
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
