<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="user/profile" class="d-block">{{ Auth::User()->name }}</a>
        </div>
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
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/category" class="nav-link {{ request()->is('category') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Category
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/category2" class="nav-link {{ request()->is('category2') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Category 2
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/" class="nav-link {{ request()->is('news') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        News
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/news/restore/" class="nav-link {{ request()->is('restore') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Restore
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="nav-link {{ request()->is('logout') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="/" class="nav-link {{ request()->is('restore') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Category 2
                    </p>
                </a>
            </li> --}}
        </ul>
    </nav>
</div>
