<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            @if( Auth::check() )
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
            @endif
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item @if( request()->is('admin/dashboard*') ) menu-open @endif">
                    <a href="#" class="nav-link @if( request()->is('admin/dashboard*') ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboards
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if( request()->is('admin/dashboard') ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('user_management_access')
                <li class="nav-item @if( request()->is('admin/tenant*') || request()->is('admin/user*') || request()->is('admin/role*') || request()->is('admin/permission*') ) menu-open @endif">
                    <a href="#" class="nav-link @if( request()->is('admin/tenant*') || request()->is('admin/user*') || request()->is('admin/role*') || request()->is('admin/permission*') ) active @endif">
                        <i class="fas fa-user-shield"></i>
                        <p>
                            Authentication
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('tenant_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.tenants.index') }}" class="nav-link @if( request()->is('admin/tenant*') ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tenants</p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if( request()->is('admin/user*') ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link @if( request()->is('admin/role*') ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}" class="nav-link @if( request()->is('admin/permission*') ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <li class="nav-item @if( request()->is('admin/some*') ) menu-open @endif">
                    <a href="#" class="nav-link @if( request()->is('admin/some') ) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
