<style>
    .div_center {
        text-align: center !important;
        margin: auto !important;
    }

    .div_pad {
        padding: 1.5rem 0 !important;
    }

    .title_design {
        font-size: 2rem;
        font-weight: bold;
        color: #1c1c1c;
        margin-top: 2rem;
    }

    .input-lg {
        font-size: 1.2rem;
        padding: 0.75rem;
        height: 3.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        padding: 0.5rem;
        border-radius: 8px;
    }

    .shadow-sm {
        box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1);
    }

    .form-floating input,
    .form-floating select,
    .form-floating textarea {
        border-radius: 5px;
        font-size: 1.1rem;
        padding: 0.75rem;
        height: 3.5rem;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-size: 1.2rem;
    }

    th {
        background-color: skyblue;
        padding: 10px;
    }

    th, td {
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>

<base href="/public">
@extends('admin.masterview')
@section('location')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <h1 class="title_design text-center">Offers</h1>

            <form action="{{ url('store_offer') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" name="coupon_code" id="coupon_code" class="form-control input-lg"
                        placeholder="Coupon Code" value="{{ old('coupon_code') }}">
                    <span class="text-danger">
                        @error('coupon_code')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="minimum_purchase">Minimum Purchase</label>
                    <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control input-lg"
                        placeholder="Minimum Purchase" value="{{ old('minimum_purchase') }}" step="1">
                    <span class="text-danger">
                        @error('minimum_purchase')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control input-lg"
                        placeholder="Discount" value="{{ old('discount') }}" step="1">
                    <span class="text-danger">
                        @error('discount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4">
                    <input type="submit" value="Add Offer" class="btn btn-info">
                </div>

            </form>
        </div>

        <div class="mt-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Minimum Purchase</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offer as $data)
                            <tr>
                                <td>{{ $data->coupon_code }}</td>
                                <td>{{ $data->minimum_purchase }}</td>
                                <td>{{ $data->discount }}</td>
                                <td>
                                    <a href="{{ url('edit-offer', $data->id) }}" class="btn btn-primary">Update</a>
                                    <a onclick="confirmation(event)" href="{{ url('delete_offer', $data->id) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
