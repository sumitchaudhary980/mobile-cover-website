<style>
th,td{
    text-wrap: nowrap;
}
</style>
@extends('admin.masterview')

@section('location')
    <div class="order-list table-responsive">
        <h4 class="mb-4 text-primary">Recent Orders</h4>

        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date Placed</th>
                    <th scope="col">Items</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Mode Of Payment</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $data)
                    <tr>
                        <td>ORD-000{{ $data->id }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->product_names }}</td>
                        <td>{{ $data->total_price }}</td>
                        <td>{{ $data->mode }}</td>
                        <td>{{ $data->address }}</td>
                        @if ($data->status == 'pending')
                            <td class="text-warning">{{ $data->status }}</td>
                        @elseif($data->status == 'Confirmed')
                            <td class="text-warning">{{ $data->status }}</td>
                        @elseif($data->status == 'Shipped')
                            <td class="text-primary">{{ $data->status }}</td>
                        @elseif($data->status == 'Delivered')
                            <td class="text-success">{{ $data->status }}</td>
                        @else
                            <td class="text-danger">{{ $data->status }}</td>
                        @endif

                        @if ($data->status == 'pending')
                            <td class="text-center">
                                <a href="{{ url('confirm_order', $data->id) }}"
                                    class="btn btn-primary text-white">Confirm</a>
                            </td>
                            <td class="text-center">
                                <a onclick="confirmation(event)" href="{{ url('cancel_order', $data->id) }}"
                                    class="btn btn-danger text-white">Cancel</a>
                            </td>
                        @elseif($data->status == 'Confirmed')
                            <td class="text-center">
                                <a href="{{ url('ship_order', $data->id) }}" class="btn btn-primary text-white">Ship</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('deliver_order',$data->id) }}" class="btn btn-success text-white">Deliver</a>
                            </td>
                        @elseif($data->status == 'Shipped')
                            <td class="text-center">

                                <a href="{{ url('deliver_order',$data->id) }}" class="btn btn-success text-white">Deliver</a>
                            </td>
                            <td></td>
                        @else
                            <td>
                                <p>You can only now delete order</p>
                            </td>
                            <td></td>
                        @endif

                        <td class="text-center">
                            <a onclick="confirmation(event)" href="{{ url('delete_order', $data->id) }}"
                                class="btn btn-danger text-white">Delete</a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
