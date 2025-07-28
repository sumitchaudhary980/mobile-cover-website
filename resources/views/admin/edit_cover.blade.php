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

            <h1 class="cat_header text-center">Edit Case</h1>

            <form action="{{ url('update-case/' . $cover->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="name">Cover Name</label>
                    <input type="text" name="cover_name" id="name" class="form-control input-lg" placeholder="Cover Name"
                        value="{{ $cover->cover_name }}" required>
                    <span class="text-danger">
                        @error('cover_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="price">Cover Price</label>
                    <input type="number" name="cover_price" id="price" class="form-control input-lg" placeholder="Cover Price"
                        value="{{ $cover->cover_price }}" step="0.01" required>
                    <span class="text-danger">
                        @error('cover_price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="quantity">Cover Quantity</label>
                    <input type="number" name="cover_quantity" id="quantity" class="form-control input-lg" placeholder="Cover Quantity"
                        value="{{ $cover->cover_quantity }}" step="1">
                    <span class="text-danger">
                        @error('cover_quantity')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control input-lg" placeholder="Description">{{ $cover->description }}</textarea>
                    <span class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="models-select">Model</label>
                    <select name="model" id="models-select" class="form-control input-lg" required>
                        <option disabled selected>Choose Model</option>
                        @foreach ($mobile as $data)
                            <option value="{{ $data->id }}" {{ $cover->model == $data->id ? 'selected' : '' }}>
                                {{ $data->mobile_model }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('model')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="type">Case Type</label>
                    <select name="type" id="type" class="form-control input-lg" required>
                        <option disabled selected>Select Case Type</option>
                        <option value="Snap Case" {{ $cover->cover_type == 'Snap Case' ? 'selected' : '' }}>Snap Case</option>
                        <option value="Soft Silicone Case" {{ $cover->cover_type == 'Soft Silicone Case' ? 'selected' : '' }}>Soft Silicone Case</option>
                        <option value="Glossy Metal TPU Case" {{ $cover->cover_type == 'Glossy Metal TPU Case' ? 'selected' : '' }}>Glossy Metal TPU Case</option>
                    </select>
                    <span class="text-danger">
                        @error('type')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4 shadow-sm p-3 rounded">
                    <label for="cover_img">Cover Image: </label>
                    <input type="file" name="cover_img" id="cover_img" class="form-control input-lg" onchange="previewImage(event)">
                    <img src="{{ asset('assets/image/' . $cover->cover_img) }}" id="imagePreview" alt="Cover Image"
                        style="max-width: 200px; margin-top: 10px;">
                    <span class="text-danger">
                        @error('cover_img')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-4">
                    <input type="submit" value="Update Case" class="btn btn-primary">
                </div>

            </form>

            <style>
                .input-lg {
                    font-size: 1.2rem;
                    padding: 0.75rem;
                    height: 3.5rem;
                }
            </style>

            <script>
                function previewImage(event) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = URL.createObjectURL(event.target.files[0]);
                    imagePreview.onload = function() {
                        URL.revokeObjectURL(imagePreview.src); // Free memory
                    }
                }
            </script>
@endsection
