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

        <div class="row text-center mb-4">
            <div class="col-12">
                <h3 class="text-dark">Leave a Message</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 p-3 bg-white shadow-lg bg-body rounded">
                <form action="{{ url('contact_form') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="text-dark">Your Name</label>
                        <input type="text" class="form-control shadow-lg border-dark" id="name" name="full_name"
                            value="{{ old('full_name') }}" @error('full_name') is-invalid @enderror>
                         @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email1" class="text-dark">Your Email</label>
                        <input type="email" class="form-control shadow-lg border-dark" id="email1" name="email"
                            value="{{ old('email') }}" @error('email') is-invalid @enderror>
                         @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="mobile" class="text-dark">Your Number</label>
                        <input type="number" class="form-control shadow-lg border-dark" id="mobile" name="phone_number"
                            min="1" value="{{ old('phone_number') }}" @error('phone_number') is-invalid @enderror>
                        <span class="text-danger">
                            @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                        </span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="message" class="text-dark">Your Message</label>
                        <textarea name="message" id="message" class="form-control border-dark" rows="6" value="{{ old('message') }}" @error('message') is-invalid @enderror></textarea><br>
                         @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-100 shadow border-dark">Send Message</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container p-5 my-5 bg-white text-black bg-body">
            <div class="text-center mb-4">
                
                <h3 class="text-dark text-capitalize">Contact Detail</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque, reiciendis.</p>
            </div>


            <div class="row">
                <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i> <br>
                            <a href="https://maps.app.goo.gl/T4jodxMH8es8N3UH7" target="_blank"
                                class="text-decoration-none text-dark">
                                Vrindavan Society Main Rd, Ambedkar Nagar, Nana Mava, Rajkot, Gujarat 360005
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-phone fa-2x"></i> <br>
                            <a href="https://wa.me/+917781827741" target="_blank" class="text-decoration-none text-dark">
                                Chat me with on WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-envelope fa-2x"></i> <br>
                            <a href="mailto:jaiswalsumit1010@gmail.com?cc=xinghsurendra2@gmail.com" target="_blank"
                                class="text-decoration-none text-dark">
                                jaiswalsumit1010@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
