@extends('auth.layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            @include('admin.partials.error-messages')
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                <x-forms.input-text
                    name="email"
                    type="email"
                    groupClass="mb-3"
                    :value="old('email')"
                    placeholder="Email"
                    required="true"
                    iconAppend="<span class='fas fa-envelope'></span>"
                ></x-forms.input-text>
                <x-forms.input-text
                    name="password"
                    type="password"
                    groupClass="mb-3"
                    :value="old('password')"
                    placeholder="Password"
                    required="true"
                    iconAppend="<span class='fas fa-lock'></span>"
                ></x-forms.input-text>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') == 1 ? 'checked="checked"' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
@section('scripts')
@endsection
