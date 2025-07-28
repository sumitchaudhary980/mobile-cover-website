<style>

</style>
@extends('home.masterview')
@section('location')
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-2 d-none d-lg-block left-line">
                <hr>
            </div>
            <div class="col-8 col-md-6 col-lg-4 text-center fs-4" style="border: 2px solid gray;">
                <div class="text-uppercase">
                    offers & deals
                </div>
            </div>
            <div class="col-2 d-none d-lg-block right-line">
                <hr>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
                    <div class="card text-white text-center p-2" style="background: #CB997E">
                        <p class="card-text mb-1">Order above ₹ 297 & get</p>
                        <h5 class="card-title mb-1">Free Shipping</h5>
                        <p class="card-text mb-2">All Over India!</p>
                        <button class="btn btn-danger btn-sm">No Coupon Needed</button>
                        <p class="card-text mt-2">The offer will be applied automatically</p>
                    </div>
                </div>

                @foreach ($offer as $offer)
                    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">

                        <div class="card text-white text-center p-2" style="background: {{ $offer->background_color }}">
                            <p class="card-text mb-1">Order above ₹ {{ $offer->minimum_purchase}} & get</p>
                            <h5 class="card-title mb-1">Extra ₹ {{ $offer->discount }} Off</h5>
                            <p class="card-text mb-2">on your entire purchase!</p>
                            <button class="btn btn-danger btn-sm">{{ $offer->coupon_code }}</button>
                            <p class="card-text mt-2">On your all orders, Enter {{ $offer->discount_code }} code to avail
                                the offer</p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    {{-- <div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(1).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3  col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(2).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(3).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(4).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3  col-md-43 col-lg-3 mb-3">
                    <img src="assets/image/offer(5).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(6).svg" alt="loading..." class="img-fluid">
                </div>
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
                    <img src="assets/image/offer(7).svg" alt="loading..." class="img-fluid">
                </div>
            </div> --}}
    </div>
    </div>
@endsection
