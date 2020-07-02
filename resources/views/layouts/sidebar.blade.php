<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#"
               class="d-block">{{ Auth::guard('admin')->user()->name ?? Auth::guard('user')->user()->name }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->

    <!-- This is menu for Admin -->
    @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Account Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('admin')}} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{route('user')}} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('company')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Company Mangement
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Device Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('device')}} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Device</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{route('user')}} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Device</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    @else
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Company Mangement
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Device Management
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
