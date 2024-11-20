@extends('layouts.client_layout')


@section('content')
    <main class="main ">

        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <form action="{{ route('vnpay.initiatePayment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- {{dd($listing)}}; --}}
            <div class="page-content  ">
                <div class="cart ">
                    <div class="container summary ">
                        <div class="row  pb-2">
                            <div class="col-3 col-md-2 mx-2">
                                <img class="mx-5" src="{{ $listing->firstImage->image_name }}" width="100px"
                                    alt="">
                            </div>
                            <div class="col-7 mx-md-1 mx-5">
                                <h5>{{ $listing->title }}</h5>
                                <p><i class="fa-regular fa-eye fa-xs"></i> {{ $listing->views }}
                                </p>
                                <p><i class="fa-solid fa-location-dot fa-xs"></i> {{ $listing->address }} </p>
                                <p>Date posted: {{ date('D, d M Y', strtotime($listing->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="row  pb-2 ">
                            <div class=" col-md-5">

                                <p class="fo" id="">
                                    <span id="description">The sale news is in normal status. Do you want to push it to the
                                        front page of the system so that more people will be interested?</span><br>
                                    <span id="price" style="color:red"></span>
                                </p>

                            </div>
                            <div class="col-md-4">
                                <select name="vip_package_id" id="vip_package_id" class="form-control" required>
                                    <option value="" required>Sellect Package</option>
                                    @foreach ($vipPackages as $vipPackage)
                                        <option value="{{ $vipPackage->vip_package_id }}"
                                            data-v="{{ $vipPackage->description }}" data-price="{{ $vipPackage->price }}">
                                            {{ $vipPackage->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-3 ">
                                <input type="hidden" name="channel_id" >
                                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                                <input type="hidden" name="sale_new_id" value="{{ $listing->sale_new_id }}">
                                {{-- <input type="hidden" name="mobile" value="null">
                                <input type="hidden" name="email" value="null">
                                <input type="hidden" name="fullName" value="null"> --}}

                                <input class="btn btn-primary btn-rounded" type="submit" value="Payment">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <style>
        .tv2 {
            display: flex;
            /* background-color: rgb(108, 99, 99); */
            border-radius: 2px;

        }

        .tv {
            /* background-color: rgb(182, 168, 168); */
            /* height: 500px; */
        }

        .fo {
            /* height: 40px; */
            padding: 0.85rem 2rem;
            font-size: 1.4rem;
            line-height: 1.5;
            font-weight: 300;
            color: #777;
            background-color: #fafafa;
            border: 1px solid #ebebeb;
            border-radius: 0;
            margin-bottom: 2rem;
            transition: all 0.3s;
            box-shadow: none;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("vip_package_id").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var value = selectedOption.getAttribute("data-v");
            var value_price = selectedOption.getAttribute("data-price");
            document.getElementById("description").textContent = value;
            document.getElementById("price").textContent = value_price;
        });
    </script>
@endsection
