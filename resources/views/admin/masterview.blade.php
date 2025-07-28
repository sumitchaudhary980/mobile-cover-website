<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            background-image: url(assets/image/bg-body.avif);
        }

        .logo {
            width: 150px;
        }
    </style>
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <img src="assets/image/logo.png" alt="Logo" class="img-fluid logo">
            <i class="fa-solid fa-bars icn menuicn" id="menuicn" alt="menu-icon"></i>
        </div>

        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                    class="icn srchicn" alt="search-icon">
            </div>
        </div>

        {{-- <a href="{{url('profile')}}">
        <div class="message">
            <div class="dp">
                <img src="assets/image/{{$user->profile_photo}}"
                    class="dpicn" alt="dp">
            </div>
        </div>
</a> --}}
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="{{ url('dashboard') }}" class="text-decoration-none">
                        <div class="nav-option option1">
                            <i class="fa-solid fa-gauge nav-icon"></i>
                            <p> Dashboard</p>
                        </div>
                    </a>
                      <a href="{{ url('manage-orders') }}" class="text-decoration-none">
                        <div class="nav-option option3">
                            <i class="fas fa-box  nav-icon"></i>
                            <p>Manage Order</p>
                        </div>
                    </a>

                    <a href="{{ url('add-mobile') }}" class="text-decoration-none">
                        <div class="option2 nav-option">

                            <i class="fa-solid fa-mobile-screen nav-icon"></i>
                            <p> Add Mobile</p>
                        </div>
                    </a>
                  
                    <a href="{{ url('add-case') }}" class="text-decoration-none">
                        <div class="nav-option option3">
                            <i class="fa-sharp-duotone fa-solid fa-mobile nav-icon"></i>
                            <p>Add Case</p>
                        </div>
                    </a>

                    <a href="{{ url('view-cover') }}" class="text-decoration-none">
                        <div class="nav-option option3">
                            <i class="fa-sharp-duotone fa-solid fa-mobile nav-icon"></i>
                            <p>All Covers</p>
                        </div>
                    </a>

                      <a href="{{ url('manage-offer') }}" class="text-decoration-none">
                        <div class="nav-option option3">
                            <i class="fa-solid fa-tag nav-icon"></i>
                            <p>Manage Offers</p>
                        </div>
                    </a>

                    <a href="{{ url('profile') }}" class="text-decoration-none">
                        <div class="nav-option option5">
                            <i class="fa-solid fa-gear nav-icon"></i>
                            <p>Setting</p>
                        </div>
                    </a>

                    <a href="{{ url('users') }}" class="text-decoration-none">
                        <div class="nav-option option6">
                            <i class="fa fa-user nav-icon"></i>
                            <p>Manage User</p>
                        </div>
                    </a>

                    <a href="{{ url('message') }}" class="text-decoration-none">
                        <div class="nav-option option6">
                            <i class="fa fa-message nav-icon"></i>
                            <p>Messages</p>
                        </div>
                    </a>

                    <div class="nav-option logout">
                        <i class="fa-solid fa-circle-arrow-left nav-icon"></i>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="text-decoration-none" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>



                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            @yield('location')

        </div>
    </div>

    <script src="./index.js"></script>
</body>

</html>

<script>
    let menuicn = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");

    menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
</script>


<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);

        swal({
                title: "Are you sure to Delete this",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
    }
   
</script>
