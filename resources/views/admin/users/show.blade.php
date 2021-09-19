@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Details</li>
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
                    <h3 class="card-title">User Details</h3>

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
                        <x-show-field colClass="col-lg-2 col-md-3" label="Created at">{{ $user->created_at }}</x-show-field>
                        <x-show-field colClass="col-lg-2 col-md-3" label="Updated at">{{ $user->updated_at }}</x-show-field>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            @can('user_edit')
                                <a href="{{ route('admin.users.edit', $user) }}" role="button" class="btn btn-info px-5">Edit</a>
                            @endcan
                            @can('user_access')
                                <a href="{{ route('admin.users.index') }}" role="button" class="btn btn-primary px-5">List</a>
                            @endcan
                            @can('user_delete')
                                <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.users.destroy', $user) }}', '{{ route('admin.users.index') }}', 'User: {{ $user->name }}')">Delete</a>
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
