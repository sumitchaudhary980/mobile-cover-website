<style type="text/css">
    .div_center {
        text-align: center !important;
        margin: auto !important;
    }

    .cat_header {
        font-size: 30px;
        font-weight: bold;
        padding: 30px;
    }

    th {
        background-color: skyblue;
        padding: 10px
    }

    th,
    td {

        white-space: nowrap;
    }
</style>
@extends('admin.masterview')
@section('location')
    <div class="box-container">
        <div class="content-wrapper">
            <div class="row ">
                <div class="col-12">

                    <div class="table-responsive">

                        <div class="div_center">

                            <div class="col-12">
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>


                            <h1 class="cat_header">Add Mobile</h1>

                            <form action="{{ url('add_mobile') }}" method="POST">

                                @csrf

                                <div class="form-group">
                                    <label for="mobile">Mobile Name</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control"><br>
                                    <span class="text-danger">
                                        @error('mobile')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model Name</label>
                                    <input type="text" name="model" id="model"class="form-control"> <br>
                                    <span class="text-danger">
                                        @error('model')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> <br>
                                <input class="btn btn-primary" type="submit" value="Add Mobile">
                            </form>


                            <div class="mt-5">

                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th scope="col">Mobile Name</th>
                                            <th scope="col">Model Name</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($mobiles as $data)
                                            <tr>
                                                <td>{{ $data->mobile }}</td>
                                                <td>{{ $data->mobile_model }}</td>
                                                <td>

                                                    <a onclick="confirmation(event)"
                                                        href="{{ url('delete_mobile', $data->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
