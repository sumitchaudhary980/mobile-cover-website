<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f2f5;
    }

    .logo{
        justify-content: center;
    }

    .logo img {
        width: 150px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .authentication-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #45a049;
    }

    /* Validation Errors */
    .validation-errors {
        color: #e3342f;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .validation-errors ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .validation-errors li {
        margin-bottom: 5px;
    }

    /* Responsive Styles */
    @media (max-width: 600px) {
        .authentication-card {
            padding: 15px;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@extends('home.masterview')

@section('location')
    <div class="container" style="margin-top: 100px">
        <div class="authentication-card">
            <div class="logo">
                <img src="assets/image/logo.png" alt="">
            </div>

            <div class="col-12">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                  @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>


            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="validation-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <div class="form-group mt-4">
                    <label for="password">Password</label>
                    <input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password">
                </div>

                <div class="form-group block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ url('forget-password') }}">
                        Forgot your password?
                    </a>

                    <button class="ms-4 btn btn-primary">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
