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

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="bg-white shadow-lg mt-3 p-3">
            <h1 class="text-center text-primary mb-4">Your Orders</h1>

            <div class="order-list table-responsive">
                <h4 class="mb-4">Recent Orders</h4>
                @if ($count == 0)
                    <p>No orders placed</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date Placed</th>
                                <th scope="col">Items</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Cancel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $data)
                                <tr>
                                    <td>ORD-000{{ $data->id }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->product_names }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>${{ $data->total_price }}</td>
                                    @if ($data->status == 'pending')
                                        <td><span class="badge bg-warning">{{ $data->status }}</span></td>
                                    @elseif($data->status == 'Confirmed')
                                        <td><span class="badge bg-warning">{{ $data->status }}</span></td>
                                    @elseif($data->status == 'Shipped')
                                        <td><span class="badge bg-primary">{{ $data->status }}</span></td>
                                    @elseif($data->status == 'Delivered')
                                        <td><span class="badge bg-success">{{ $data->status }}</span></td>
                                    @else
                                        <td><span class="badge bg-danger">{{ $data->status }}</span></td>
                                    @endif
                                    @if ($data->status == 'Delivered')
                                        <td>
                                            <p>You canno't cancel it now if you have any query or issue releated with it
                                                contact
                                                our team through contact page</p>
                                        </td>
                                    @elseif($data->status == 'Cancelled')
                                        <td>
                                            <p>Order has been already cancelled</p>
                                        </td>
                                    @else
                                        <td><a href="{{ url('cancel-order', $data->id) }}" name="cancel">Cancel Order</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                @endif


                </tbody>
                </table>



            </div>
        </div>
    </div>
@endsection
