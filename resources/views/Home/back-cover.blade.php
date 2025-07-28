@extends('home.masterview')

@section('location')
    <div class="container" style="margin-top: 80px">
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

        <div class="row text-dark">
            <div class="col-12 d-flex flex-wrap align-items-center navigation">
                <div class="d-flex flex-wrap align-items-center">
                    <a href="{{ url('/') }}" class="text-uppercase text-decoration-none" style="color:gray">Home /</a>
                    <a href="{{ url('mobile-cover') }}" class="text-uppercase text-decoration-none"
                        style="color:gray">Mobile
                        Cover /</a>
                    <h5 class="text-uppercase ms-2 mb-0">Back Covers</h5>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start text-gray mb-3 mb-md-0"
                style="color:gray">
                <i class="fas fa-sliders-h me-2"></i> Filter
            </div>
            <div class="col-12 col-md-8 d-flex justify-content-center justify-content-md-end align-items-center">
                <p class="mb-0 me-2 d-none d-md-block" style="color:gray">Showing 1-4 of 8 results</p>
                <form action="mobile-cover" method="POST">
                    @csrf
                    <select name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="Default Sorting" {{ $sort == 'Default Sorting' ? 'selected' : '' }}>Default Sorting
                        </option>
                        <option value="Sort by latest" {{ $sort == 'Sort by latest' ? 'selected' : '' }}>Sort by latest
                        </option>
                        <option value="Sort by price: low to high"
                            {{ $sort == 'Sort by price: low to high' ? 'selected' : '' }}>Sort by price: low to high
                        </option>
                        <option value="Sort by price: high to low"
                            {{ $sort == 'Sort by price: high to low' ? 'selected' : '' }}>Sort by price: high to low
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="text-center">Back Cover</h4>
                <p>Back Cover- Buy Stylish Back Covers and Cases Start from just at
                    Rs. 99 On DesigAura. Shop Best Apple Iphone Xs Max Back Cover Online in India with Reasonable Price.
                    Checkout and Order Latest Mobile Phone Back Cover of Trendy Huge Collection.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($cover as $item)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ url('details/' . $item->id) }}" class="text-dark">
                        <div class="image">
                            <img src="assets/image/{{ $item->cover_img }}" alt="Loading.." class="img-fluid xsmax">
                        </div>
                        <div class="content">
                            <p class="text-capitalize">{{ $item->cover_name }}</p>
                            <p>₹{{ $item->cover_price }}</p>
                    </a>
                    <a href="{{ url('add-cart', $item->id) }}">
                        <button class="btn btn-dark text-uppercase">add to cart</button>
                    </a>
                </div>


        </div>
        @endforeach

    </div>


    </div>
    </div>

    </style>
@endsection
<script>
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });
</script>
