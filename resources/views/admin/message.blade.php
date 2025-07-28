@extends('admin.masterview')
@section('location')
    <h3 class="text-uppercase text-center my-5">unread message's</h3>
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="row gap-1">

        @foreach ($contact as $data)
            <div class="container p-3 col-12 col-sm-12 col-md-5 bg-white shadow-lg bg-body rounded text-center ">

                <h4>
                    {{ $data->name }}
                </h4>
                <p class="p-0 m-0">
                    {{ $data->message }}
                </p>
                <a onclick="confirmation(event)" href="{{ url('delete-message', $data->id) }}"
                    class="btn btn-primary float-left w-auto rounded my-2"
                    onclick="alert('Do you want to delete this message?')">Delete Message</a>


                <!-- here -->
                <a href="mailto:{{ $data->email }}" target="_blank"
                    class="btn btn-primary float-left w-auto rounded my-2">Reply
                    Message</a>
            </div>
        @endforeach


    </div>
@endsection
