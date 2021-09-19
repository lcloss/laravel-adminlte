@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset( $tenant ) ? 'Tenant edit' : 'New Tenant' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset( $tenant ) ? 'Tenant edit' : 'New Tenant' }}</li>
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
                        <h3 class="card-title">{{ isset( $tenant ) ? $tenant->name : 'New Tenant' }}</h3>

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
                        <form action="{{ isset( $tenant ) ? route('admin.tenants.update', $tenant) : route('admin.tenants.store') }}" method="POST">
                            @csrf
                            @if( isset( $tenant ) )
                                @method('PUT')
                            @endif

                            @include('admin.partials.error-messages')
                            <div class="row">
                                <x-forms.input-text
                                    name="name"
                                    type="name"
                                    label="Name"
                                    groupClass="col-md-6"
                                    :value="old('name', $tenant->name ?? '')"
                                    placeholder="Tenant Name"
                                    required="true"
                                ></x-forms.input-text>
                                <x-forms.input-select
                                    name="status"
                                    label="Status"
                                    groupClass="col-md-3"
                                    value="{{ isset( $tenant ) ? old('status', $tenant->getRawOriginal('status') ) : old('status') }}"
                                    :options="$statuses"
                                    required="true"
                                ></x-forms.input-select>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success px-5">{{ isset( $tenant ) ? 'Update' : 'Create' }}</button>
                                    @if( isset( $tenant ))
                                    @can('tenant_show')
                                        <a href="{{ route('admin.tenants.show', $tenant) }}" role="button" class="btn btn-info px-5">View</a>
                                    @endcan
                                    @endif
                                    @can('tenant_access')
                                        <a href="{{ route('admin.tenants.index') }}" role="button" class="btn btn-primary px-5">List</a>
                                    @endcan
                                    @if( isset( $tenant ))
                                    @can('tenant_delete')
                                        <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.tenants.destroy', $tenant) }}', '{{ route('admin.tenants.index') }}', 'Tenant: {{ $tenant->name }}')">Delete</a>
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
