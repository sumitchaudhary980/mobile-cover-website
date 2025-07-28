@extends('admin.masterview')
@section('location')
    <div class="container">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded-circle"
                                                    style="height: 140px; background-color: rgb(233, 236, 239);">
                                                    <img src="{{ $user->profile_photo ? asset('assets/image/' . $user->profile_photo) : asset('assets/image/profile.webp') }}"
                                                        alt="" style="width: 140px; height: 140px;" class="img-fluid rounded-circle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                                                <div class="mt-2">
                                                    <a href="{{ url('edit-profile') }}">
                                                        <button class="btn btn-outline-primary mb-2">
                                                            <i class="fas fa-user"></i> Edit Profile
                                                        </button>
                                                    </a>
                                                    <a href="{{ url('change-password') }}">
                                                        <button class="btn btn-outline-primary mb-2">
                                                            <i class="fas fa-lock"></i> Change Password
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="text-center text-sm-right">
                                                <span class="btn btn-outline-secondary">{{ $user->usertype }}</span>
                                                <div class="text-muted"><small>Joined on <br>{{ $user->created_at->format('M d, Y') }}</small></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Full Name</label>
                                                        <input class="form-control form-control-lg" id="name" type="text" name="name"
                                                            value="{{ $user->name }}" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="email">Email</label>
                                                        <input class="form-control form-control-lg" id="email" type="text" name="email"
                                                            value="{{ $user->email }}" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="phone">Phone</label>
                                                        <input class="form-control form-control-lg" id="phone" type="text" name="phone"
                                                            value="{{ $user->phone }}" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="state">State</label>
                                                        <input class="form-control form-control-lg" id="state" type="text" name="state"
                                                            value="{{ $user->state }}" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="city">City</label>
                                                        <input class="form-control form-control-lg" id="city" type="text" name="city"
                                                            value="{{ $user->city }}" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control form-control-lg" id="address" name="address" rows="3" disabled>{{ $user->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                        <div class="card mb-3 shadow-sm border-0 rounded">
                            <div class="card-body">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="px-xl-3">
                                        <button class="btn btn-danger btn-block">
                                            <i class="fa fa-sign-out"></i> Log Out
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Support</h6>
                                <p class="card-text">Get fast, free help from our friendly assistants.</p>
                                <a href="{{ url('contact') }}">
                                    <button type="button" class="btn btn-outline-primary">Contact Us</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
