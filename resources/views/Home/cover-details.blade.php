<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }
</style>
@extends('home.masterview')
@section('location')
    <div class="container" style="margin-top:100px">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12 col-md-7 mb-4 mb-md-0">
                <img src="assets/image/{{ $cover->cover_img }}" alt="Default Image" class="img-fluid">
            </div>
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex  flex-md-row mb-3 redirect">
                            <a href="{{ url('/') }}" class="text-uppercase text-decoration-none anchor me-2"
                                style="color: gray;">Home</a>
                            <span class=" d-md-inline">/</span>
                            <a href="{{ url('mobile-cover') }}" class="text-uppercase text-decoration-none anchor mx-2"
                                style="color: gray;">Mobile Cover</a>


                        </div>
                        <h4 class="text-dark">{{ $cover->cover_name }}</h4>
                        <p class="price">
                            ₹{{ $cover->price }}
                            {{-- <span class="discount" style="text-decoration: none">₹99.00</span> --}}
                        </p>

                        <img src="assets/image/Free-Shipping-2.svg" alt="Free Shipping" class="img-fluid">
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="30" src="https://zapvi.in/wp-content/uploads/2021/04/feather.png"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text">
                            Thin & light Poly-carbonate case
                        </div>
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="30"
                                src="https://zapvi.in/wp-content/uploads/2019/07/painting.png"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text">
                            Smooth & seam-free surface
                        </div>
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="30"
                                src="https://zapvi.in/wp-content/uploads/2021/04/return-box.png"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text">
                            Hassle-free replacements
                        </div>
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="30"
                                src="https://zapvi.in/wp-content/uploads/2021/04/shipping-and-delivery.png"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text">


                            Delivery in 5-7 working days

                        </div>
                    </div>
                    {{-- <form action="{{url('add-cart')}}" method="POST">
                        @csrf
                        <div class="row mt-4">

                            <div class="col-12 col-md-6">
                                <select name="mobile brand" id="mobile-brand" class="form-control"
                                    onchange="toggleModels(this)" required>
                                    <option value="">Choose Mobile Brand</option>
                                    <option value="Apple">Apple</option>
                                    <option value="Vivo">Vivo</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 d-none" id="apple-models">
                                <select name="apple-model" id="models" class="form-control" required>
                                    <option value="">Choose Your Model</option>
                                    <option value="Apple Iphone 11 Pro">Apple Iphone 11 Pro</option>
                                    <option value="Apple Iphone 12 Pro">Apple Iphone 12 Pro</option>
                                    <option value="Apple Iphone 13 Pro">Apple Iphone 13 Pro</option>
                                    <option value="Apple Iphone 14 Pro">Apple Iphone 14 Pro</option>
                                    <option value="Apple Iphone XS Max">Apple Iphone XS Max</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 d-none" id="vivo-models">
                                <select name="vivo-model" id="models" class="form-control">
                                    <option value="">Choose Your Model</option>
                                    <option value="Vivo V21">Vivo V21</option>
                                    <option value="Vivo X70 Pro">Vivo X70 Pro</option>
                                    <option value="Vivo Y33s">Vivo Y33s</option>
                                    <option value="Vivo V23">Vivo V23</option>
                                </select>
                            </div>
                        </div>


                        <div class="button mt-3">
                            <button class="btn btn-warning text-light text-uppercase">Add To Cart</button>
                        </div>
                    </form> --}}
                    <div class="content d-flex mt-2">
                        <div class="image">
                            <img width="30" height="60" src="https://zapvi.in/wp-content/uploads/2020/12/tag.svg"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text mx-2">
                            <p class="text-dark">Order Above Rs. 297 & Get Free Shipping <br> <span>Use Coupon Code:
                                </span><span class="bg-danger text-light">No Coupon Needed</span></p>

                        </div>
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="60" src="https://zapvi.in/wp-content/uploads/2020/12/tag.svg"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text mx-2">
                            <p class="text-dark">Order above ₹ 399 & Get Extra ₹ 60 OFF <br> <span>Use Coupon Code:
                                </span><span class="bg-success text-light text-uppercase">Save60</span></p>

                        </div>
                    </div>
                    <div class="content d-flex">
                        <div class="image">
                            <img width="30" height="60" src="https://zapvi.in/wp-content/uploads/2020/12/tag.svg"
                                class="attachment-medium size-medium" alt="" decoding="async" loading="lazy">
                        </div>
                        <div class="text mx-2">
                            <p class="text-dark">Order above ₹ 599 & Get Extra ₹ 100 OFF
                                <br> <span>Use Coupon Code: </span><span
                                    class="bg-success text-light text-uppercase">Save100</span>
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 left-line">
                            <hr>
                        </div>
                        <div class="col-4">
                            <p class="text-uppercase" style="color: gray">our categories</p>
                        </div>
                        <div class="col-4 right-line">
                            <hr>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6 col-md-6 col-lg-4">
                            <div class="card shadow-lg homecard">
                                <a href="{{ url('snap-mobile-cover') }}" class="a">
                                    <img class="card-img-top" src="assets/image/card2.webp" alt="Card image">
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <div class="card shadow-lg homecard">
                                <a href="{{ url('silicone-mobile-cover') }}" class="a">
                                    <img class="card-img-top" src="assets/image/card3.webp" alt="Card image">
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <div class="card shadow-lg homecard">
                                <a href="{{ url('glossy-metal-tpu-mobile-cover') }}" class="a">
                                    <img class="card-img-top" src="assets/image/card4.webp" alt="Card image">
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <div class="card shadow-lg homecard">
                                <a href="{{ url('mobile-cover') }}" class="a">
                                    <img class="card-img-top" src="assets/image/card1.webp" alt="Card image">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr class="mt-4">
            <div class="row">
                <div class="col-12 col-md-3">
                    <p class="text-uppercase">Description</p>
                </div>
                <div class="col-12 col-md-9">
                    <div class="images">
                        <img src="assets/image/description(1).jpg" alt="Loading..." class="img-fluid">
                        <img src="assets/image/description(2).jpg" alt="Loading..." class="img-fluid">
                        <img src="assets/image/description(3).jpg" alt="Loading..." class="img-fluid">
                    </div>
                    <div class="content d-flex">
                        <div class="sub-content">
                            <p class="text-uppercase material">material</p>
                            <span class="description" style="color: gray">Impact resistant and highly durable
                                polycarbonate.</span>
                        </div>
                    </div>
                    <hr>
                    <div class="content d-flex">
                        <div class="sub-content">
                            <p class="text-uppercase material">print</p>
                            <span class="description" style="color: gray"> Matte finish ultra HD Lifetime warranty on
                                print. Super-bright colors embedded directly into the case. Made with high precision to get
                                a crisp clear print. The Colorful patterns let you express your unique personality. Our
                                Unique Edge-to-edge Printing technology provides a smooth clean look that really stands out
                                from ordinary Mobile Back Covers & Cases</span>
                        </div>
                    </div>
                    <hr>
                    <div class="content d-flex">
                        <div class="sub-content">
                            <p class="text-uppercase material">PRODUCT SPECIALITY</p>
                            <span class="description" style="color: gray">Slim fitting with design wrapping around side of
                                the case and full access to ports. Compatible with standard wireless charging. Despite a
                                very thin profile and Weight 15 Gram(Negligible Weight), the case is much stronger than it
                                looks at first sight.
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="content d-flex">
                        <div class="sub-content">
                            <p class="text-uppercase material">Product details</p>
                            <span class="description" style="color: gray">Slim, One-piece, Clip-on, Light, Durable
                                Polycarbonate Protective Hard Case. Includes cut-outs for your regular charger and
                                headphones. Provides Easy Protection for Your Smartphone. All side design Case covers 100%
                                of the outer surface of the phone. Precision molded with no seams or sharp edges. High
                                quality printing No peeling, chipping, or wearing off.
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="content">
                        <p style="color:gray"><span style="text-decoration:underline;">Please Note: </span>Colors May
                            Slightly Vary Depending on Your Screen Brightness.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <p class="text-uppercase">additional product information</p>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="content">
                            <p style="color:black">Net quantity: <span style="color: gray">1</span></p>
                            <p style="color:black">Country of origin: <span style="color: gray">India</span></p>
                            <p style="color:black">Manufactured by: <span style="color: gray">DesignAura 23-24 4th Floor
                                    Girivar Industrial Park, Saniya Hemad Village, Near Saroli, Surat-kadodara Road, Surat,
                                    Gujarat - 395006 </span></p>
                            <p style="color:black">Packed by: <span style="color: gray">DesignAura 23-24 4th Floor Girivar
                                    Industrial Park, Saniya Hemad Village, Near Saroli, Surat-kadodara Road, Surat, Gujarat
                                    - 395006</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function toggleModels(selectElement) {
        var appleModels = document.getElementById('apple-models');
        var vivoModels = document.getElementById('vivo-models');

        // Hide all models sections
        appleModels.classList.add('d-none');
        vivoModels.classList.add('d-none');

        // Show selected brand models section
        if (selectElement.value === 'Apple') {
            appleModels.classList.remove('d-none');
        } else if (selectElement.value === 'Vivo') {
            vivoModels.classList.remove('d-none');
        }
    }
</script>
