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
        padding: 20px;
        /* Added padding to prevent content from touching the edges */
        box-sizing: border-box;
        /* Ensures padding is included in the width */
    }

    .authentication-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        box-sizing: border-box;
        /* Ensures padding is included in the width */
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
        box-sizing: border-box;
        /* Ensures padding is included in the width */
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
        display: inline-block;
        text-align: center;
        text-decoration: none;
        /* Ensures no underline */
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

@extends('admin.masterview')

@section('location')
    <base href="/public">
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container">

        <div class="authentication-card">
            <div class="logo">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Logo">
            </div>

            <form method="POST" action="{{ url('update_password') }}">
                @csrf

                <div class="form-group mt-4">
                    <label for="old_password">Old Password</label>
                    <input id="old_password" class="block mt-1 w-full" type="password" name="old_password" required>
                    <span class="text-danger">
                        @error('old_password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mt-4">
                    <label for="password">New Password</label>
                    <input id="password" class="block mt-1 w-full" type="password" name="password" required>
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mt-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                        required autocomplete="new-password">
                    <span class="text-danger">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="btn btn-primary">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
