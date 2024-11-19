@extends('layouts.client_layout')


@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <main class="main">

        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">New</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View news status</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="summary ">
                        <div class="profile">
                            <div class="container">
                                <div class="row">
                                    {{-- <div class="col-10"> --}}
                                    @if (auth()->user()->image_user)
                                        <img src="{{ asset(auth()->user()->image_user) }}" alt="Profile Image" />
                                    @else
                                        <img src="https://kynguyenlamdep.com/wp-content/uploads/2022/06/anh-gai-xinh-cuc-dep.jpg"
                                            alt="Profile Image" />
                                    @endif
                                    <span>
                                        <h6 class="text-black p-3">{{ auth()->user()->full_name }}</h6>
                                    </span>

                                    <button class="btn btn-primary btn-rounded">+ New Channel</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="tabs-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-5-tab" data-toggle="tab" href="#tab-5" role="tab"
                                    aria-controls="tab-5" aria-selected="true">NOW SHOWING ({{ $count_now_showing }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-6-tab" data-toggle="tab" href="#tab-6" role="tab"
                                    aria-controls="tab-6" aria-selected="false">PENDING APPROVAL
                                    ({{ $count_pending_approval }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-7-tab" data-toggle="tab" href="#tab-7" role="tab"
                                    aria-controls="tab-7" aria-selected="false">NOT ACCEPTED ({{ $count_not_accepted }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-8-tab" data-toggle="tab" href="#tab-8" role="tab"
                                    aria-controls="tab-8" aria-selected="false">ITEM IS SOLD ({{ $count_hidden }})</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-border" id="tab-content-2">
                            <div class="tab-pane fade active show" id="tab-5" role="tabpanel"
                                aria-labelledby="tab-5-tab">

                                <div class="listing-card">
                                    @foreach ($list_now_showing as $item)
                                        {{-- {{ dd($item) }} --}}
                                        <div class="card-content mb-2">
                                            <div class="container p-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div style="display: flex">
                                                            <img src="{{ asset($item->firstImage->image_name) }}"
                                                                width="50px" alt="" srcset="">
                                                            <h2>{{ $item->title }}</h2>
                                                        </div>
                                                        <p class="price">$ {{ $item->price }}</p>

                                                        <p class="date">Date posted: {{ $item->created_at }}</p>
                                                        {{-- <p class="expiry">Expiration date: 18:19 16/01/25</p> --}}
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="views">Views: {{ $item->views }}</p>
                                                        @if ($item->vip_package_id)
                                                            <b>
                                                                <p class="services">{{ $item->vipPackage->name }}</p>
                                                            </b>
                                                        @else
                                                            <p class="services">No service yet</p>
                                                        @endif



                                                        <a href="{{ route('salenew.detail', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Detail</a>
                                                        <a href="{{ route('salenew.promote', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Push to the top </a>
                                                        {{-- <a href="#" class="btn btn-outline-dark btn-rounded">Unhide</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>



                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tab-6-tab">


                                <div class="listing-card">
                                    @foreach ($list_pending_approval as $item)
                                        <div class="card-content mb-2">
                                            <div class="container p-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div style="display: flex">
                                                            <img src="{{ asset($item->firstImage->image_name) }}"
                                                                width="50px" alt="" srcset="">
                                                            <h2>{{ $item->title }}</h2>
                                                        </div>
                                                        <p class="price">$ {{ $item->price }}</p>

                                                        <p class="date">Date posted: {{ $item->created_at }}</p>
                                                        {{-- <p class="expiry">Expiration date: 18:19 16/01/25</p> --}}
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="views">Views: {{ $item->views }}</p>
                                                        @if ($item->vip_package_id)
                                                            <b>
                                                                <p class="services">{{ $item->vipPackage->name }}</p>
                                                            </b>
                                                        @else
                                                            <p class="services">No service yet</p>
                                                        @endif



                                                        <a href="{{ route('salenew.detail', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Detail</a>

                                                        <a href="{{ route('salenew.promote', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Push to the top </a>
                                                        {{-- <a href="#" class="btn btn-outline-dark btn-rounded">Unhide</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="tab-7-tab">

                                <div class="listing-card">
                                    @foreach ($list_not_accepted as $item)
                                        <div class="card-content mb-2">
                                            <div class="container p-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div style="display: flex">
                                                            <img src="{{ asset($item->firstImage->image_name) }}"
                                                                width="50px" alt="" srcset="">
                                                            <h2>{{ $item->title }}</h2>
                                                        </div>
                                                        <p class="price">$ {{ $item->price }}</p>

                                                        <p class="date">Date posted: {{ $item->created_at }}</p>
                                                        {{-- <p class="expiry">Expiration date: 18:19 16/01/25</p> --}}
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="views">Views: {{ $item->views }}</p>
                                                        @if ($item->vip_package_id)
                                                            <b>
                                                                <p class="services">{{ $item->vipPackage->name }}</p>
                                                            </b>
                                                        @else
                                                            <p class="services">No service yet</p>
                                                        @endif



                                                        <a href="{{ route('salenew.detail', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Detail</a>

                                                        @if ($item->vip_package_id != null)
                                                            <a href="{{ route('salenew.promote', $item->sale_new_id) }}"
                                                                class="btn btn-primary btn-rounded">Push to the top </a>
                                                        @endif
                                                        {{-- <a href="#" class="btn btn-outline-dark btn-rounded">Unhide</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="tab-8-tab">

                                <div class="listing-card">
                                    @foreach ($list_hidden as $item)
                                        <div class="card-content mb-2">
                                            <div class="container p-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div style="display: flex">
                                                            <img src="{{ asset($item->firstImage->image_name) }}"
                                                                width="50px" alt="" srcset="">
                                                            <h2>{{ $item->title }}</h2>
                                                        </div>
                                                        <p class="price">$ {{ $item->price }}</p>

                                                        <p class="date">Date posted: {{ $item->created_at }}</p>
                                                        {{-- <p class="expiry">Expiration date: 18:19 16/01/25</p> --}}
                                                    </div>
                                                    <div class="col-5">
                                                        <p class="views">Views: {{ $item->views }}</p>
                                                        @if ($item->vip_package_id)
                                                            <b>
                                                                <p class="services">{{ $item->vipPackage->name }}</p>
                                                            </b>
                                                        @else
                                                            <p class="services">No service yet</p>
                                                        @endif



                                                        <a href="{{ route('salenew.detail', $item->sale_new_id) }}"
                                                            class="btn btn-primary btn-rounded">Detail</a>

                                                        {{-- <a href="{{ asset('salenew.promote',{{ $item->sale_new_id }}) }}" class="btn btn-primary btn-rounded">Push to the top </a> --}}
                                                        {{-- <a href="#" class="btn btn-outline-dark btn-rounded">Unhide</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div>
                </div>
            </div>

        </div>


    </main><!-- End .main -->

    <style>
        .listing-card {
            /* background: #d7d7d756; */
            /* border-radius: 8px; */
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            /* padding: 20px; */
            /* width: 300px; */
        }

        .card-content {
            border-radius: 8px 1px;
            background: #efeeee61;
            text-align: left;
        }

        .card-content h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .card-content .price {
            font-size: 1.5em;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .card-content .location,
        .date,
        .expiry,
        .views,
        .services {
            margin-bottom: 10px;
            color: #555;
        }

        .card-content .details,
        .renew {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card-content .renew {
            background-color: #28a745;
        }

        .card-content .details:hover,
        .renew:hover {
            background-color: #0056b3;
        }

        .page-content {
            /* max-width: 1px; */
            margin: 0 auto;
            padding-left: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile img {
            border-radius: 80%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .profile span {
            font-size: 1.2em;
            margin-right: auto;
        }

        .create-store-btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }





        .illustration img {
            width: 100px;
            height: auto;
        }
    </style>
@endsection
