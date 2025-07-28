@extends('admin.masterview')
<div class="col-12">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

@section('location')
    <form action="{{ url('store_cover') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" name="cover_name" id="name" class="form-control" placeholder="Cover Name"
                value="{{ old('cover_name') }}">
            <label for="name">Cover Name</label> <br>
            <span class="text-danger">
                @error('cover_name')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="cover_price" id="price" class="form-control" placeholder="Cover Price"
                value="{{ old('cover_price') }}" step="0.01" min="1">
            <label for="price">Cover Price</label> <br>
            <span class="text-danger">
                @error('cover_price')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3">
            <textarea name="description" id="description" class="form-control" placeholder="Description"
                value="{{ old('description') }}"></textarea>
            <label for="description">Description</label> <br>
            <span class="text-danger">
                @error('description')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3" id="mobile-brand-container">
            <select name="mobile" id="mobile-brand" class="form-control" onchange="toggleModels(this)">
                <option disabled selected>Select Mobile Brand</option>
                @foreach ($mobile as $data)
                    <option value="{{ $data->id }}" {{ old('mobile') == $data->mobile ? 'selected' : '' }}>
                        {{ $data->mobile }}
                    </option>
                @endforeach

            </select>
            <label for="mobile-brand">Mobile</label> <br>
            <span class="text-danger">
                @error('mobile')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3" id="models">
            <select name="model" id="models-select" class="form-control">
                <option disabled selected>Choose Your Model</option>
                @foreach ($mobile as $data)
                    <option value="{{ $data->model }}" {{ old('mobile') == $data->mobile ? 'selected' : '' }}>
                        {{ $data->mobile_model }}
                    </option>
                @endforeach


            </select>
            <label for="models-select">Model</label> <br>
            <span class="text-danger">
                @error('model')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <label for="cover_img">Cover Image:</label>
            <input type="file" name="cover_img" id="cover_img" value="{{ old('cover_img') }}"> <br>
            <span class="text-danger">
                @error('cover_img')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <input type="submit" value="Add Cover" class="btn btn-info">
    </form>
@endsection
