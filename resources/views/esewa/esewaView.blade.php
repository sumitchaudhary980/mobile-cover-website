@extends('home.masterview')

@section('location')
    <div id="app" style="margin-top: 100px">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <marquee behavior="scroll" direction="left" scrollamount="5"
                            style="font-size: 20px; color: #ff0000; font-weight: bold;">
                            Don't press the back button or refresh the page while payment is in process.
                        </marquee>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif

                        <div class="card card-default">
                            <div class="card-header">
                                DesignAura- Payment Page
                            </div>
                            @if (session()->has('discount'))
                                @php
                                    $discount = session('discount');
                                    $totalPrice = $totalPrice - $discount;
                                @endphp
                            @endif
                            <div class="card-body text-center">
                                <form method="POST" action="/esewa/initiate-payment">
                                    @csrf
                                    <input type="hidden" name="amount" value="100">
                                    <input type="hidden" name="order_id" value="TEST123">
                                    <button type="submit">Pay with eSewa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
