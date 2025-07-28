<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f2f5;
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
            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                link that will allow you to choose a new one.
            </div>

            <form method="POST" action="{{ route('password-email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" autofocus autocomplete="username">
                </div>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>

                <div class="flex items-center justify-end mt-4">
                    <button class="btn btn-primary">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
