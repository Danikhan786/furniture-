<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Furni Free </title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">Oasis Mubales<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">About us</a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('shop') || request()->routeIs('productDetail') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('shop') || request()->routeIs('productDetail') ? 'active' : '' }}"
                            href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact us</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <img src="../../frontend/images/cart.svg" alt="Cart">
                        </a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../frontend/images/user.svg" alt="User">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li class="dropdown-item-text">
                                    <small class="text-muted">{{ Auth::user()->name }}</small>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @if (Auth::user()->type == 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-tachometer-alt me-2"></i> Admin Dashboard
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="fa fa-home me-2"></i> Home Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <img src="../../frontend/images/user.svg" alt="Login">
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    @yield('content')

    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="../../frontend/images/sofa.png" alt="Image" class="img-fluid">
            </div>



            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Oasis Mubales<span>.</span></a>
                    </div>
                    <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus
                        malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
                        Pellentesque habitant</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">shop</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Knowledge base</a></li>
                                <li><a href="#">Live chat</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Jobs</a></li>
                                <li><a href="#">Our team</a></li>
                                <li><a href="#">Leadership</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>


                    </div>
                </div>

            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>. All Rights Reserved.</a>
                            <!-- License information: https://untree.co/license/ -->
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </footer>
    <!-- End Footer Section -->


    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
