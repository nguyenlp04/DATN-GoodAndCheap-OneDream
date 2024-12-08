<main class="main">
    <style>
        .image-container {
            width: 100%;
            height: 200px;
            /* Đặt chiều cao cố định cho khung chứa */
            overflow: hidden;
            /* Đảm bảo không có phần thừa nào bị hiển thị */
        }

        .equal-height-image {
            height: 200px;
            /* Đặt chiều cao cố định cho tất cả các ảnh */
            width: 100%;
            /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của khung chứa */
            object-fit: cover;
            /* Đảm bảo ảnh phủ kín khung mà không bị méo */
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="intro-slider-container mb-5">
        <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
            data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
            <div class="intro-slide"
                style="background-image: url({{$setting->banner1}});">
            </div><!-- End .intro-slide -->

            <div class="intro-slide"
                style="background-image: url({{$setting->banner2}});">

            </div><!-- End .intro-slide -->

            <div class="intro-slide"
                style="background-image: url({{$setting->banner3}});">

            </div><!-- End .intro-slide -->
        </div><!-- End .intro-slider owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->



    <div class="container">
        <h2 class="title text-center mb-4">Explore Categories</h2><!-- End .title text-center -->
        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="{{ route('category') }}?category={{ $category->category_id }}" class="cat-block">
                        <figure>
                            <span>
                                <img style="max-width: 120px;max-height: 70px;" src="{{ asset($category->image_category ?: '') }}" alt="Category image">
                            </span>
                        </figure>
                        <h3 class="cat-block-title">{{ $category->name_category }}</h3><!-- End .cat-block-title -->
                    </a>
                </div><!-- End .col-sm-4 col-lg-2 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .cat-blocks-container -->
    </div><!-- End .container -->
    <div class="mb-4"></div><!-- End .mb-4 -->



    <div class="mb-3"></div><!-- End .mb-5 -->

    <div class="container new-arrivals">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">New Arrivals</h2><!-- End .title -->
            </div>

            <!-- End .heading-left -->


        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel just-action-icons-sm">
            <div class="tab-pane p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
                    @foreach ($data as $item)



                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-top">Top</span>
                            <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}" class="image-container">
                                @if ($item->images->isNotEmpty())
                                <img src="{{asset($item->images->first()->image_name) }}" alt="Image"
                                    class="equal-height-image">
                                @endif
                            </a>




                            <div class="product-action-vertical">

                                <!-- Thêm data-product-id để lưu id sản phẩm -->
                                <form action="{{ route('addToWishlist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sale_new_id" value="{{ $item->sale_new_id }}">
                                    <button type="submit"
                                        class="   add-wishlist  {{ $item->isFavorited ? ' text-white bg-primary' : 'text-primary' }}  rounded-circle    add-to-wishlist-btn"
 
                                        title="{{ $item->isFavorited ? ' ' : ' Add to wishlist' }}  ">  <i class="fas fa-heart"></i></button>
 


                            </div>
                        </figure>
                        <!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a
                                    href="{{ route('salenew.detail' ,$item->sale_new_id) }}">{{ Str::limit($item->title, 35, '...') }} </a></h3>
                            <div class="product-price">
                                ${{ $item->price }}
                            </div>
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                    @endforeach


                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->


        </div><!-- End .tab-content -->
    </div><!-- End .container -->


    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <div class="cta cta-border mb-5" style="background-image: url(assets/images/demos/demo-4/bg-1.jpg);">
            <img src="assets/images/demos/demo-4/camera.png" alt="camera" class="cta-img">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="cta-content">
                        <div class="cta-text text-right text-white">
                            <p>Shop Today’s Deals <br><strong>Awesome Made Easy. HERO7 Black</strong></p>
                        </div><!-- End .cta-text -->
                        <a href="#" class="btn btn-primary btn-round"><span>Shop Now - $429.99</span><i
                                class="icon-long-arrow-right"></i></a>
                    </div><!-- End .cta-content -->
                </div><!-- End .col-md-12 -->
            </div><!-- End .row -->
        </div><!-- End .cta -->
    </div><!-- End .container -->


    <div class="bg-light pt-5 pb-6">
        <div class="container trending-products">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">Trending Products</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="trending-top-link" data-toggle="tab"
                                href="#trending-top-tab" role="tab" aria-controls="trending-top-tab"
                                aria-selected="true">Top Rated</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trending-best-link" data-toggle="tab" href="#trending-best-tab"
                                role="tab" aria-controls="trending-best-tab" aria-selected="false">Best
                                Selling</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trending-sale-link" data-toggle="tab" href="#trending-sale-tab"
                                role="tab" aria-controls="trending-sale-tab" aria-selected="false">On Sale</a>
                        </li>
                    </ul>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="row">
                <div class="col-xl-5col d-none d-xl-block">
                    <div class="banner">
                        <a href="#">
                            <img src="assets/images/demos/demo-4/banners/banner-4.jpg" alt="banner">
                        </a>
                    </div><!-- End .banner -->
                </div><!-- End .col-xl-5col -->

                <div class="col-xl-4-5col">
                    <div class="tab-content tab-content-carousel just-action-icons-sm">
                        <div class="tab-pane p-0 fade show active" id="trending-top-tab" role="tabpanel"
                            aria-labelledby="trending-top-link">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                                data-toggle="owl"
                                data-owl-options='{
                                            "nav": true,
                                            "dots": false,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                    "items":2
                                                },
                                                "768": {
                                                    "items":3
                                                },
                                                "992": {
                                                    "items":4
                                                }
                                            }
                                        }'>

                                @foreach ($topRated as $item)

                                <div class="product product-2">
                                    <figure class="product-media">

                                        <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">

                                            <img src="{{ $item->images->first()->image_name }}" alt="Image"
                                                class="equal-height-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist"
                                                title="Add to wishlist"></a>
                                        </div><!-- End .product-action -->


                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">Bose - SoundSport
                                                wireless headphones</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $199.99
                                        </div><!-- End .product-price -->



                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->

                                @endforeach

                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane p-0 fade" id="trending-best-tab" role="tabpanel"
                            aria-labelledby="trending-best-link">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                                data-toggle="owl"
                                data-owl-options='{
                                            "nav": true,
                                            "dots": false,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                    "items":2
                                                },
                                                "768": {
                                                    "items":3
                                                },
                                                "992": {
                                                    "items":4
                                                }
                                            }
                                            }'>
                                @foreach ($bestSelling as $item)

                                <div class="product product-2">
                                    <figure class="product-media">
                                        <span class="product-label label-circle label-new">New</span>
                                        <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">
                                            <img src="{{ $item->images->first()->image_name }}" alt="Image"
                                                class="equal-height-image">
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist"
                                                title="Add to wishlist"></a>
                                        </div><!-- End .product-action -->


                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">Bose - SoundSport
                                                wireless headphones</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $199.99
                                        </div><!-- End .product-price -->



                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->

                                @endforeach
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane p-0 fade" id="trending-sale-tab" role="tabpanel"
                            aria-labelledby="trending-sale-link">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                                data-toggle="owl"
                                data-owl-options='{
                                            "nav": true,
                                            "dots": false,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                    "items":2
                                                },
                                                "768": {
                                                    "items":3
                                                },
                                                "992": {
                                                    "items":4
                                                }
                                            }
                                        }'>
                                @foreach ($onSale as $item)

                                <div class="product product-2">
                                    <figure class="product-media">
                                        <span class="product-label label-circle label-new">Sale</span>
                                        <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">
                                            <img src="{{ $item->images->first()->image_name }}" alt="Image"
                                                class="equal-height-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist"
                                                title="Add to wishlist"></a>
                                        </div><!-- End .product-action -->


                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">Bose - SoundSport
                                                wireless headphones</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            $199.99
                                        </div><!-- End .product-price -->



                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->

                                @endforeach
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .col-xl-4-5col -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-6 -->

    <div class="mb-5"></div><!-- End .mb-5 -->

    <div class="container for-you">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Recommendation For You</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <a href="{{ url('all-sale-news') }}" class="title-link">View All Recommendadion <i
                        class="icon-long-arrow-right"></i></a>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="products">
            <div class="row justify-content-center">

                @foreach ($recommendation as $item)

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            {{-- --}}

                            <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">

                                <img src="{{ $item->images->first()->image_name }}" alt="Image"
                                    class="equal-height-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"
                                    title="Add to wishlist"></a>
                            </div><!-- End .product-action -->


                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">Bose - SoundSport
                                    wireless headphones</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $199.99
                            </div><!-- End .product-price -->



                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div>

                @endforeach


            </div><!-- End .row -->
        </div><!-- End .products -->
    </div><!-- End .container -->

    <div class="mb-4"></div><!-- End .mb-4 -->

    <div class="container">
        <hr class="mb-0">
    </div><!-- End .container -->

    <div class="icon-boxes-container bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rocket"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                            <p>Orders $50 or more</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rotate-left"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                            <p>Within 30 days</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-info-circle"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                            <p>when you sign up</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-life-ring"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                            <p>24/7 amazing services</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->

</main><!-- End .main -->

<!-- Trong Blade view -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    var userId = "{{ Auth::check() ? Auth::user()->user_id : '' }}";
    // Hiển thị thông báo sau khi load trang nếu có từ session
    @if(session('alert'))
    Swal.fire({
        icon: "{{ session('alert')['type'] }}",
        title: "{{ session('alert')['message'] }}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    @endif
</script>