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
<base href="/public">
<div class="container" style="margin-top: 100px;">
    
    <div class="authentication-card">
        <div class="logo">
            <img src="{{ asset('assets/image/logo.png') }}" alt="Logo">
        </div>

       <form method="POST" action="{{ route('reset-password.submit') }}">
    @csrf
    <input type="hidden" name="token" value="{{ request('token') }}">

    <div class="form-group mt-4">
        <label for="password">Password</label>
        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
        <span  class="text-danger">
            @error('password')
                {{$message}}
            @enderror
        </span>
    </div>

    <div class="form-group mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
         <span  class="text-danger">
            @error('password_confirmation')
                {{$message}}
            @enderror
        </span>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button class="btn btn-primary">
            Reset Password
        </button>
    </div>
</form>

    </div>
</div>
@endsection
