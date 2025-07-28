@extends('admin.masterview')

@section('location')
    <style>
        .cover_img {
            border-radius: 0px !important;
            height: 150px !important;
            width: 150px !important;
        }

        th {
            background-color: skyblue !important;
            color: white !important;
            font-size: 15px !important;
            font-weight: bold !important;
            padding: 10px !important;
        }
        th,td{
            white-space: nowrap !important;
        }

        /* Optional: Add responsive adjustments */
        @media (max-width: 576px) {
            .cover_img {
                height: 100px !important;
                width: 100px !important;
            }

            th {
                font-size: 12px !important;
                padding: 5px !important;
            }
        }
    </style>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cover Name</th>
                                <th>Cover Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Mobile Name</th>
                                <th>Model Name</th>
                                <th>Cover Image</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cover as $data)
                                <tr>
                                    <td>{{ $data->cover_name }}</td>
                                    <td>{{ $data->cover_type }}</td>
                                    <td>{{ $data->cover_price }}</td>
                                    <td>{{ $data->cover_quantity }}</td>
                                    <td>{{ $data->description }}</td>

                                    <td>{{ $data->mobile->mobile }}</td>
                                    <td>{{ $data->mobile->mobile_model }}</td>
                                    <td><img src="assets/image/{{ $data->cover_img }}" alt=""
                                            class="img-fluid cover_img"></td>
                                    <td>
                                        <a href="{{ url('delete_cover', $data->id) }}" onclick="confirmation(event)"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-cover', $data->id) }}" class="btn btn-info">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
