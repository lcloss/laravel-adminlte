@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @can('tenant_create')
                        <div class="row m-2">
                            <div class="col-md-12">
                                <a class="btn btn-primary px-4" role="button" href="{{ route('admin.users.create') }}">New User</a>
                            </div>
                        </div>
                    @endcan
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            @if( Auth::user()->isAdmin )
                                <th style="width: 16%">
                                    Tenant Name
                                </th>
                                <th style="width: 20%">
                                    User Name
                                </th>
                            @else
                                <th style="width: 36%">
                                    User Name
                                </th>
                            @endif
                            <th style="width: 16%">
                                Email
                            </th>
                            <th style="width: 10%">
                                User Roles
                            </th>
                            <th style="width: 5%">
                                Verified?
                            </th>
                            <th style="width: 5%">
                                Approved?
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                @if( Auth::user()->isAdmin )
                                    <td>
                                        {{ $user->tenant->name ?? '' }}
                                    </td>
                                @endif
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    @foreach( $user->roles as $role )
                                        <span class="badge badge-primary">{{ $role->name ?? '' }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $user->verified ? __('global.yes') : __('global.no') }}
                                </td>
                                <td>
                                    {{ $user->approved ? __('global.yes') : __('global.no') }}
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-{{ $user->getRawOriginal('status') == 'P' ? 'warning' : ( $user->getRawOriginal('status') == 'A' ? 'success' : ( $user->getRawOriginal('status') == 'S' ? 'secondary' : 'danger' ) ) }}">{{ $user->status ?? '' }}</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show', $user) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#"onclick="deleteObject('{{ route('admin.users.destroy', $user) }}', '{{ route('admin.users.index') }}', 'User: {{ $user->name }}')">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row m-2">
                        <div class="col-md-12">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
@endsection
