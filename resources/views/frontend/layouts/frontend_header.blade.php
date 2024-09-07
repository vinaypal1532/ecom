<body>

 <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                    <small class="me-3">
                        <i class="fa fa-phone-alt me-2 text-secondary"></i>
                        <a href="tel:{{ $setting->mobile_no }}" class="text-white">{{ $setting->mobile_no }}</a>
                    </small>
                    <small class="me-3">
                        <i class="fas fa-envelope me-2 text-secondary"></i>
                        <a href="mailto:{{ $setting->email }}" class="text-white">{{ $setting->email }}</a>
                    </small>
                    <small>
                        <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                        <span class="text-white">{{ $setting->address }}</span>
                    </small>
                    </div>
                  
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{ route('main')}}" class="navbar-brand"><h1 class="text-primary display-6"><img src="{{ asset('images/logo.png')}}" height="90"></h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{ route('main')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('product')}}" class="nav-item nav-link">Shop</a>                            
                            <a href="{{ route('about')}}" class="nav-item nav-link">About Us</a>        
                            <a href="{{ route('contact')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                       
                        <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-cart fa-2x"></i> <!-- Changed to shopping cart icon -->
                            <span id="cart-count" class="cart-count-container position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                <span id="cart-count-value">{{ count(session('cart', [])) }}</span>
                            </span>
                        </a>


                        @auth
                            <div class="dropdown">
                                <a href="{{ route('user-profile.index') }}" class="dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user fa-2x"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('user-profile.index') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('user-profile.index') }}">Order</a>
                                    <a class="dropdown-item" href="{{ route('user-profile.index') }}">Address</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>
   


      