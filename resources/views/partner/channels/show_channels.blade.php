@extends('layouts.client_layout')

@section('content')
<style>
    <style>
        .channel-info {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .channel-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }
        .channel-name {
            font-size: 20px;
            font-weight: bold;
        }
        .channel-username {
            font-size: 14px;
            color: #888;
        }
    </style>
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
<main class="container pt-5 mb-2">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>  
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="channel-info d-flex align-items-center p-3 border rounded-2 shadow-sm bg-light">
                <!-- Channel Image -->
                <img src="{{ asset('storage/' . $channels->image_channel) }}" alt="{{ $channels->name_channel }}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">

                <!-- Channel Details -->
                <div class="flex-grow-1">
                    <div class="channel-name fw-bold fs-5 text-primary">{{ $channels->name_channel }}</div>
                    <div class="text-muted">{{ $channels->username }}</div>
                    <div class="text-muted ">
                        {{ $channels->followers_count }} 2,3K Người Theo Dõi | 
                           <span class="text-danger">
                            <i class="bi bi-star-fill text-warning"></i> {{ $channels->rating }}  123 Đánh Giá   </span> 
                    </div>
                    <div class="d-flex gap-2 mt-2">
                        <button class="btn btn-danger mr-2 btn-sm">Follow</button>
                        <button class="btn btn-primary btn-sm">Message</button>
                    </div>
                   
                </div>

                <!-- Stats Section -->
                <div class="d-flex align-items-end" >
                    <div class="text-danger mb-1 me-2 mr-4">
                        <i class="bi bi-box-seam"></i> {{ $productsCount }} Sản Phẩm    |
                    </div>
                    
                    <div class="text-danger mb-1 me-2 mr-4">
                        <i class="bi bi-chat-dots"></i>  Tỉ Lệ Phản Hồi cao   |
                    </div>
                    <div class="text-danger mb-1 me-2 ">
                        <i class="bi bi-clock"></i> Trong vài giờ
                    </div>
                </div>
            </div>
        </div>

            <div class="container for-you">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">My product</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
        
                    <div class="heading-right">
                        <a href="#" class="title-link">View All Recommendadion <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .heading-right -->
                </div><!-- End .heading -->
        
                <div class="products">
                    <div class="row justify-content-center">
                        @if(isset($channels->product_count_message))
                        <div class="alert alert-warning">
                            {{ $channels->product_count_message }}
                        </div>
@else
                        @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 border">
                            <div class="product product-2">
                                <figure class="product-media">
                                    <a href="">
                                        <img src="{{ asset('assets/images/demos/demo-4/products/product-10.jpg') }}"

                                    </a>
                
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                    </div><!-- End .product-action -->
                
                                    <div class="product-action">
                                        <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                        <a href="" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->
                
                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Smart Home</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title">
                                        <a href="">{{ $product->name_product }}</a>
                                    </h3><!-- End .product-title -->
                                    <div class="product-price">
                                        ${{ number_format($product->price, 2) }}
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: {{ $product->ratings * 20 }}%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">({{ $product->reviews_count }} Reviews)</span>
                                    </div><!-- End .rating-container -->
                
                                    <div class="product-nav product-nav-dots">
                                      
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    @endforeach
                @endif
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- End .container -->
        </div>
       
</main>

@endsection
