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
                    <h5 class="text-uppercase ms-2 mb-0">snap mobile cover</h5>
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
                <select name="sort" id="sort" class="form-select w-auto">
                    <option value="Default Sorting">Default Sorting</option>
                    <option value="Sort by latest">Sort by latest</option>
                    <option value="Sort by price: low to high">Sort by price: low to high</option>
                    <option value="Sort by price: high to low">Sort by price: high to low</option>
                </select>
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
                    <a href="{{ url('add-cart',$item->id) }}">
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
