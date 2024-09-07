<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        @can('admin-access')
            <span class="brand-text font-weight-light">Admin</span>
        @endcan
        @can('user-access')
            <span class="brand-text font-weight-light">Sub Admin Panel</span>
        @endcan
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('user-access')
                    <li class="nav-item menu-open">
                        <a href="{{ route('employee-dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endcan
                @can('admin-access')
                    <li class="nav-item menu-open">
                        <a href="{{ route('home') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                   </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Sub Category
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('subcategories.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategories.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Product
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Order
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Payment
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('payments.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Website Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('settings') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('testimonial') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Testimonials </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-images"></i>
                            <p>
                                Banner
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('banner') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Banner List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add_banner') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Banner</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-images"></i>
                            <p>
                                Offer Managemnt
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('offers.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Offer List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offers.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Offer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
