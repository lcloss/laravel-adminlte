@extends('admin.layouts.app')
@section('styles')
    @include('admin.partials.select2Styles')
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ isset( $user ) ? 'User edit' : 'New User' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset( $user ) ? 'User edit' : 'New User' }}</li>
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
                        <h3 class="card-title">{{ isset( $user ) ? $user->name : 'New User' }}</h3>

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
                        <form action="{{ isset( $user ) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
                            @csrf
                            @if( isset( $user ) )
                                @method('PUT')
                            @endif
                            @include('admin.partials.error-messages')
                            <div class="row">
                                @if( Auth::user()->isAdmin )
                                    <x-forms.input-select
                                        name="tenant_id"
                                        label="Tenant"
                                        groupClass="col-md-6"
                                        value="{{ old('tenant_id', $user->tenant_id ?? '') }}"
                                        :options="$tenants"
                                        required="false"
                                    ></x-forms.input-select>
                                @endif
                                <x-forms.input-text
                                    name="name"
                                    type="name"
                                    label="Name"
                                    groupClass="col-md-6"
                                    :value="old('name', $user->name ?? '')"
                                    placeholder="User Name"
                                    required="true"
                                ></x-forms.input-text>
                                <x-forms.input-text
                                    name="email"
                                    type="email"
                                    label="Email"
                                    groupClass="col-md-6"
                                    :value="old('email', $user->email ?? '')"
                                    placeholder="User email"
                                    required="true"
                                ></x-forms.input-text>
                                <x-forms.input-select
                                    name="status"
                                    label="Status"
                                    groupClass="col-md-3"
                                    value="{{ isset( $user ) ? old('status', $user->getRawOriginal('status') ) : old('status') }}"
                                    :options="$statuses"
                                    required="true"
                                ></x-forms.input-select>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Approval</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" name="approved" id="approved" @if( $user->approved ?? '' ) checked="checked" @endif>
                                            <label class="custom-control-label" for="approved">Is approved ?</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" name="verified" id="verified" @if( $user->verified ?? '' ) checked="checked" @endif>
                                            <label class="custom-control-label" for="verified">Is verified ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Roles</label>
                                        @foreach( $roles as $i => $value )
                                            <div class="form-check">
                                                @if( isset( $user ) )
                                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}" @if( $user->roles->contains( $i ) ) checked="checked" @endif>
                                                @else
                                                <input class="form-check-input" type="checkbox" value="{{ $i }}" name="roles[]" id="role-{{ $i }}">
                                                @endif
                                                <label class="form-check-label">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success px-5">{{ isset( $user ) ? 'Update' : 'Create' }}</button>
                                    @if( isset( $user ) )
                                    @can('user_show')
                                        <a href="{{ route('admin.users.show', $user) }}" role="button" class="btn btn-info px-5">View</a>
                                    @endcan
                                    @endif
                                    @can('user_access')
                                        <a href="{{ route('admin.users.index') }}" role="button" class="btn btn-primary px-5">List</a>
                                    @endcan
                                    @if( isset( $user ) )
                                    @can('user_delete')
                                        <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.users.destroy', $user) }}', '{{ route('admin.users.index') }}', 'User: {{ $user->name }}')">Delete</a>
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
@section('scripts')
    @include('admin.partials.select2Scripts')
@endsection
