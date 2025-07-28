@extends('home.masterview')

@section('location')
    <div class="container" style="margin-top: 100px">
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
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded"
                                                    style="height: 140px; background-color: rgb(233, 236, 239);">
                                                    <img src="{{ empty($user->profile_photo) ? asset('assets/image/profile.webp') : asset('assets/image/' . $user->profile_photo) }}" alt=""
                                                        style="width: 140px; height:140px" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ url('update_profile') }}" class="form" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"></h4>
                                                    <div class="mt-2">
                                                        <label class="btn btn-primary">
                                                            <i class="fa fa-fw fa-camera"></i>
                                                            <span>Change Photo</span>
                                                            <input type="file" class="d-none"
                                                                onchange="previewImage(event)" name="profile_img">
                                                        </label>
                                                        <span class="text-danger">
                                                            @error('profile_img')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-center text-sm-right">
                                                    <span class="btn btn-secondary">{{ $user->usertype }}</span>
                                                    <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                                                </div>
                                            </div>

                                    </div>

                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                                                    value="{{ old('name', $user->name) }}">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                                                    value="{{ old('email', $user->email) }}">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                                                    value="{{ old('phone', $user->phone) }}">
                                                                @error('phone')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input class="form-control @error('state') is-invalid @enderror" type="text" name="state"
                                                                    value="{{ old('state', $user->state) }}">
                                                                @error('state')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input class="form-control @error('city') is-invalid @enderror" type="text" name="city"
                                                                    value="{{ old('city', $user->city) }}">
                                                                @error('city')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                                                @error('address')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                </form> <!-- Closing tag for the profile update form -->
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="px-xl-3">
                                        <button class="btn btn-block btn-secondary">
                                            <i class="fa fa-sign-out"></i>
                                            <a class="text-decoration-none text-dark" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </a>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Support</h6>
                                <p class="card-text">Get fast, free help from our friendly assistants.</p>
                                <a href="{{ url('contact') }}">
                                    <button type="button" class="btn btn-primary">Contact Us</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.e-profile img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
