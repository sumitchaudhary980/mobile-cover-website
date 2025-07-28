@extends('admin.masterview')

@section('location')
    <div class="container">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">x</button>
                </div>
            @endif
        </div>

        <h1 class="text-center text-primary mb-4">Dashboard</h1>

        <div class="main">
            <div class="searchbar2 mb-4">
                <input type="text" name="" id="" placeholder="Search" class="form-control">
                <div class="searchbtn">
                    <i class="fas fa-search icn srchicn text-white" aria-hidden="true"></i>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                        <div class="box-container">
                            <div class="box box1">
                                <div class="text">
                                    <h2 class="topic-heading">{{ $order }}</h2>
                                    <h2 class="topic">Orders Placed</h2>
                                </div>
                                <i class="fas fa-box fa-3x text-white"></i> <!-- White icon for Orders Placed -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                        <div class="box-container">
                            <div class="box box2">
                                <div class="text">
                                    <h2 class="topic-heading">{{ $mobile }}</h2>
                                    <h2 class="topic">Mobiles Varieties</h2>
                                </div>
                                <i class="fas fa-mobile-alt fa-3x text-white"></i> <!-- White icon for Mobiles Varieties -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                        <div class="box-container">
                            <div class="box box3">
                                <div class="text">
                                    <h2 class="topic-heading">{{$cover}}</h2>
                                    <h2 class="topic">Mobile Covers</h2>
                                </div>
                                <i class="fas fa-cogs fa-3x text-white"></i> <!-- White icon for Mobile Covers -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                        <div class="box-container">
                            <div class="box box3">
                                <div class="text">
                                    <h2 class="topic-heading">{{ $user }}</h2>
                                    <h2 class="topic">Registered Users</h2>
                                </div>
                                <i class="fas fa-users fa-3x text-white"></i> <!-- White icon for Registered Users -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
