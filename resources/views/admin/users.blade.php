<style>
    <style>.table {
        width: 100%;
        table-layout: auto;
        /* border: 1px solid black; */
    }

    th,
    td {

        white-space: nowrap;
    }
</style>
</style>
@extends('admin.masterview')
@section('location')
    <div class="container">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="bg-white shadow-lg mt-3 p-3">
            <h1 class="text-center text-primary mb-4">Registered Users</h1>
            <div class="order-list table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-primary">Name</th>
                            <th scope="col" class="text-primary">Email</th>
                            <th scope="col" class="text-primary">Phone Number</th>
                            <th scope="col" class="text-primary">State</th>
                            <th scope="col" class="text-primary">City</th>
                            <th scope="col" class="text-primary">Address</th>
                            <th scope="col" class="text-primary">Gender</th>
                            <th scope="col" class="text-primary">User Status</th>
                            <th scope="col" class="text-primary">Delete User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->state }}</td>
                                <td>{{ $data->city }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>
                                    @if ($data->is_active == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td><a onclick="confirmation(event)" href="{{ url('delete_user', $data->id) }}">delete
                                        user</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
