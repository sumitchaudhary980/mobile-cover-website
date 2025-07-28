@extends('home.masterview')
@section('location')
  <div class="container" style="margin-top: 80px">
    <div class="row align-items-center justify-content-between">
        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start text-gray mb-3 mb-md-0" style="color:gray">
            <i class="fas fa-sliders-h me-2"></i> Filter
        </div>
        <div class="col-12 col-md-8 d-flex justify-content-center justify-content-md-end align-items-center">
            <p class="mb-0 me-2 d-none d-md-block" style="color:gray">Showing 1-4 of 8 results</p>
            <form action="{{ url('search') }}">
                @csrf
            <select name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                <option value="Default Sorting">Default Sorting</option>
                <option value="Sort by latest">Sort by latest</option>
                <option value="Sort by price: low to high">Sort by price: low to high</option>
                <option value="Sort by price: high to low">Sort by price: high to low</option>
            </select>
            </form>
        </div>
    </div>

    <div class="row">
        @if (isset($data) && $data->count())
            @foreach ($data as $item)
                <div class="col-6 col-md-4 col-lg-3 mb-4"> <!-- Added mb-4 to create space between rows -->
                    <a href="{{ url('details/' . $item->id) }}" class="text-dark">
                        <div class="image">
                            <img src="assets/image/{{ $item->cover_img }}" alt="Loading.." class="img-fluid xsmax">
                        </div>
                        <div class="content">
                            <p class="text-capitalize">{{ $item->cover_name }}</p>
                           <p>₹{{ $item->cover_price }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            @if (isset($search))
                <div class="mt-3">
                    <p>No results found.</p>
                </div>
            @endif
        @endif
    </div>
</div>

</div>
</div>
@endsection
