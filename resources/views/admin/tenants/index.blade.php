@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tenants</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tenants</li>
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
                    <h3 class="card-title">Tenants</h3>

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
                            <a class="btn btn-primary px-4" role="button" href="{{ route('admin.tenants.create') }}">New Tenant</a>
                        </div>
                    </div>
                    @endcan
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 71%">
                                Tenant Name
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $tenants as $tenant )
                            <tr>
                                <td>
                                    {{ $tenant->id }}
                                </td>
                                <td>
                                    {{ $tenant->name ?? '' }}
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-{{ $tenant->getRawOriginal('status') == 'P' ? 'warning' : ( $tenant->getRawOriginal('status') == 'A' ? 'success' : ( $tenant->getRawOriginal('status') == 'S' ? 'secondary' : 'danger' ) ) }}">{{ $tenant->status ?? '' }}</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.tenants.show', $tenant) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.tenants.edit', $tenant) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#" onclick="deleteObject('{{ route('admin.tenants.destroy', $tenant) }}', '{{ route('admin.tenants.index') }}', 'Tenant: {{ $tenant->name }}')">
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
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
@endsection
