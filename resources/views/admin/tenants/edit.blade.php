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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tenant Name" value="{{ old('tenant', $tenant->name ?? '') }}">
                                        @error('name')
                                        <span id="emailMsgError" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="">{{ __('global.pleaseSelect') }}</option>
                                            @foreach( Config::get('constants.status') as $code => $value)
                                                @if( isset( $tenant) )
                                                    <option value="{{ $code }}" @if( $code == old('status', $tenant->getRawOriginal('status') ) ) selected="selected" @endif>{{ __($value) }}</option>
                                                @else
                                                    <option value="{{ $code }}">{{ __($value) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <span id="emailMsgError" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">{{ isset( $tenant ) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.tenants.index') }}" role="button" class="btn btn-danger px-5">List</a>
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
