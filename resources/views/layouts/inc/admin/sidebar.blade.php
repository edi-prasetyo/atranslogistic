<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ $option->second_logo_url }}" alt="AdminLTE Logo" class="img-fluid" style="width: 70%">
        {{-- <span class="brand-text font-weight-light">Atrans<br> Express</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('superadmin')
                    <li class="nav-item">
                        <a href="{{ url('orders') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('vehicles') }}" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Kendaraan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('categories') }}" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Kategori Barang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('routes') }}" class="nav-link">
                            <i class="nav-icon fas fa-route"></i>
                            <p>
                                Tarif Rute
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('wallets') }}" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>
                                Wallet
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('wallets/topup') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Topup</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('wallets/withdraw') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Withdraw</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>
                                Area
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('provinces') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Provinsi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('cities') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kota</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pengguna
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('users') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('users/counter') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Counter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('users/courier') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kurir</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-header">SETTINGS</li>
                    <li class="nav-item">
                        <a href="{{ url('roles') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Role
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">PENGGUNA</li>
                    <li class="nav-item">
                        <a href="{{ url('users') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Users
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
                @endrole



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
