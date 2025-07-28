<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="/public">
    <link rel="icon" type="image/x-icon" href="assets/image/favicon1.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-image: url(assets/image/bg-body.avif);
        }

        .logo {
            width: 150px
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="assets/image/logo.png" alt="loading..." class="img-fluid logo">
            </a>
            <!-- Toggler Button for Mobile View -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex flex-column flex-lg-row w-100 justify-content-between">
                    <!-- Navbar Nav Items -->
                    <ul class="navbar-nav mx-auto mx-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('mobile-cover') }}">Mobile Cover</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('offer') }}">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                        </li>
                    </ul>
                    <!-- Search Form -->
                    <form action="{{ url('search') }}" method="GET" class="form-inline my-2 my-lg-0 mx-auto mx-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ isset($search) ? $search : '' }}">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                                      <!-- Cart and Login Icons -->
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cart') }}"><i class="fas fa-shopping-cart"></i> Cart</a>
                        </li>



                        @auth
                            <!-- User Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <!-- Display user name -->
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ url('profile') }}">Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Log Out</button>
                                        </form>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('my_orders') }}">Orders</a></li>
                                </ul>
                            </li>
                        @else
                            <!-- Guest Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </div>
        
    </nav>


    @yield('location')


      <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #1c2331; margin-top: 100px;">
        <!-- Section: Social media -->
        <section class="d-flex flex-column flex-md-row align-items-center p-4" style="background-color: #6351ce;">
            <!-- Left -->
            <div class="mb-3 mb-md-0">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Right -->
            <div class="d-flex flex-wrap justify-content-center">
                <a href="#" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links -->
        <section>
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">DesignAura</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px;">
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px;">
                        <p><a href="{{ url('mobile-cover') }}" class="text-white">Mobile Cover</a></p>
                        <p><a href="{{url('snap-mobile-cover')}}" class="text-white">Snap Case</a></p>
                        <p><a href="{{url('silicone-mobile-cover')}}" class="text-white">Soft Silicone Case</a></p>
                        <p><a href="{{url('glossy-metal-tpu-mobile-cover')}}" class="text-white">Glossy Metal TPU Case</a></p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px;">
                        <p><a href="{{url('profile')}}" class="text-white">Your Account</a></p>
                        <p><a href="#" class="text-white">Become an Affiliate</a></p>
                        <p><a href="#" class="text-white">Shipping Rates</a></p>
                        <p><a href="{{url('contact')}}" class="text-white">Help</a></p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px;">
                        <p><i class="fas fa-home me-3"></i>New Delhi, Near Red fort, India</p>
                        <p><i class="fas fa-envelope me-3"></i> noreplygreencoffee@gmail.com</p>
                        <p><i class="fas fa-phone me-3"></i> + 91 7781827741</p>
                        <p><i class="fas fa-print me-3"></i> + 91 7879057976</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="{{ url('/') }}">DesignAura</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->


</body>

</html>

<script>
    window.addEventListener('scroll', function() {
        var navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
