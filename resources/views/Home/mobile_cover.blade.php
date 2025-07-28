<style>
    .li {
        font-family: 'Mukta', sans-serif;
        margin-top: 10px;
    }

    .dropdown-item {
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .dropdown-summary {
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        outline: none;
        user-select: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown-summary::after {
        content: '\25b6';
        /* Right arrow */
        font-size: 0.75em;
        margin-left: auto;
        transform-origin: center;
        transition: transform 0.2s ease;
    }

    details[open] .dropdown-summary::after {
        transform: rotate(90deg);
        /* Rotates the arrow to point downwards */
    }

    .dropdown-content {
        padding: 10px;
        border-top: 1px solid #ddd;
    }
</style>
@extends('home.masterview')
@section('location')
    <div class="container" style="margin-top: 100px">


        <div class="content text-center">
            <h3 style="color: gray;font-weight: 600">Mobile Cover</h3>

            <p style="color: gray;">
                <span style="font-weight: 600; color: gray;">Mobile Cover</span> - Buy Stylish Mobile Back Cover and Cases
                Just at Rs. 99 On DesignAura. Get Best Mobile Back Covers Online in India with Reasonable Price. Checkout
                and
                Order Latest Phone Covers of Trendy Huge Collection.
            </p>
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 col-lg-4">
                    <div class="input-group">
                        <input type="search" name="search" placeholder="Search Your Phone Model" class="form-control" />
                        <button class="btn bg-warning" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-4">
                @foreach ($data as $item)
                    <details class="dropdown-item">
                        <summary class="dropdown-summary">{{ $item->mobile }}</summary>
                        <a href="{{ url('cover/' . $item->id) }}">
                            <p class="dropdown-content">{{ $item->model }}</p>
                        </a>
                    </details>
                @endforeach
            </div>
        </div>

    </div>
@endsection

<script>
    function toggleModels(id, element) {
        var modelsDiv = document.getElementById(id + '-models');
        modelsDiv.classList.toggle('expanded');

        var icon = element.querySelector('.icon i');
        if (modelsDiv.classList.contains('expanded')) {
            icon.classList.remove('fa-angle-down');
            icon.classList.add('fa-angle-up');
        } else {
            icon.classList.remove('fa-angle-up');
            icon.classList.add('fa-angle-down');
        }
    }
</script>
