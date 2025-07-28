@extends('home.masterview')

@section('location')
    <section class="bg-light" style="margin-top: 100px">
        <div class="container">
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

            <div class="row">

                <!-- cart -->
                <div class="col-lg-9">
                    <div class="card border shadow-0">
                        <div class="m-4">
                            <h4 class="card-title mb-4">Your shopping cart</h4>

                            @forelse ($cart as $item)
                                <div class="row gy-3 mb-4">
                                    <div class="col-lg-5">
                                        <div class="me-lg-5">
                                            <div class="d-flex">
                                                <a href="{{ url('details', $item->product_id) }}">
                                                    <img src="{{ asset('assets/image/' . $item->product_image) }}"
                                                        class="border rounded me-3" style="width: 96px; height: 96px;" />
                                                </a>
                                                <div class="d-flex w-100">
                                                    <a href="{{ url('details', $item->product_id) }}">
                                                        <h5 class="text-black">{{ $item->product_name }}</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                        Quantity:
                                        <div class="col-8">
                                            <input type="number" class="form-control" min="1"
                                                value="{{ $item->quantity }}"
                                                onchange="window.location.href='{{ url('update-quantity') }}?qnt=' + this.value + '&pid={{ $item->id }}'">
                                        </div>
                                        <div class="">
                                            <text class="h6">${{ $item->total_price }}</text> <br />
                                            <small class="text-muted text-nowrap">${{ $item->product_price }} / per
                                                item</small>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                        <div class="float-md-end">
                                            <a href="{{ url('delete-cart', $item->id) }}"
                                                class="btn-danger btn-sm text-danger" style="text-decoration:none">
                                                <i class="fa fa-trash"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Your cart is empty.</p>
                            @endforelse

                            <div class="border-top pt-4 mx-4 mb-4">
                                <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
                                <p class="text-muted">
                                    Experience the ultimate in mobile cover personalization with our premium designs,
                                    shipped to you with complimentary delivery, ensuring arrival within 1-2 weeks. Enjoy the
                                    perfect blend of style and protection as you adorn your phone with our unique covers.
                                    From sleek, minimalistic designs to vibrant, artistic patterns, our collection offers
                                    something for every taste. Elevate your phone's look and safeguard it with covers that
                                    reflect your personality, all delivered right to your doorstep, bringing a touch of
                                    elegance and practicality to your daily life.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cart -->

                <!-- summary -->
                <div class="col-lg-3">
                    <div class="card mb-3 border shadow-0">
                        <div class="card-body">
                            <form method="post" action="{{ url('apply-coupon') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Have coupon?</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border" name="coupon" value=""
                                            placeholder="Coupon code" required />
                                        <button class="btn btn-primary border" name="applyBtn" type="submit">Apply</button>
                                        <br>
                                    </div>
                                    <span id='show'></span><br>
                                    <i class="fa-solid fa-tag"></i>
                                    <a href="{{ url('offer') }}" class="text-decoration-none text-dark">view more coupons
                                        <i class="fa-solid fa-chevron-right flex-end"></i>
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card shadow-0 border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total price:</p>
                                <p class="mb-2">{{ $totalPrice }}</p>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Discount:</p>
                                @if (session()->has('discount'))
                                @php
                                    $discount=session('discount');
                                    $totalPrice=$totalPrice-$discount;
                                @endphp
                                    {{ $discount}}
                                @else
                                    <p class="mb-2 text-success">$0</p>
                                @endif

                            </div>

                            <hr />
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total price:</p>
                               
                                    <p class="mb-2 text-success">${{ $totalPrice }}</p>
                                
                            </div>

                            <div class="mt-3">
                                <a href="{{ url('checkout') }}" class="btn btn-primary w-100 shadow-0 mb-2">Make
                                    Purchase</a>
                                <a href="{{ url('mobile-cover') }}" class="btn btn-primary w-100 border mt-2">Back to
                                    shop</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- summary -->

            </div>
        </div>
    </section>
@endsection
