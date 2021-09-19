@extends('admin.layouts.app')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permission edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Permission edit</li>
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
                        <h3 class="card-title">{{ $permission->name }}</h3>

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
                        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('admin.partials.error-messages')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Permission Name" value="{{ old('permission', $permission->name) }}">
                                        @error('name')
                                        <span id="emailMsgError" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Roles</label>
                                        @foreach( $roles as $i => $value )
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}" @if( $permission->roles->contains( $i ) ) checked="checked" @endif>
                                                <label class="form-check-label">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
                                    <a href="{{ route('admin.permissions.index') }}" permission="button" class="btn btn-danger px-5">List</a>
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
