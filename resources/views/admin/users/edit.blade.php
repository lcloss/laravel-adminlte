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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" value="{{ old('user', $user->name ?? '') }}">
                                        @error('name')
                                        <span id="emailMsgError" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="User Name" value="{{ old('user', $user->email ?? '') }}">
                                        @error('email')
                                        <span id="emailMsgError" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="">{{ __('global.pleaseSelect') }}</option>
                                            @foreach( Config::get('constants.status') as $code => $value)
                                                @if( isset( $user ) )
                                                    <option value="{{ $code }}" @if( $code == old('status', $user->getRawOriginal('status') ) ) selected="selected" @endif>{{ __($value) }}</option>
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
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">{{ isset( $user ) ? 'Update' : 'Create' }}</button>
                                    <a href="{{ route('admin.users.index') }}" role="button" class="btn btn-danger px-5">List</a>
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
