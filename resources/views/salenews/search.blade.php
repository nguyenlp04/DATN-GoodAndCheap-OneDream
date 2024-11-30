@extends('layouts.client_layout') @section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search</li>
                </ol>
            </div>
        </nav>
        {{-- {{ dd($vipSaleNews->user->created_at) }} --}}

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-2 col-xl-4-5col px-3">
                        <div class="mb-2"></div>
                        <!-- End .mb-2 -->

                        <h2 class="title title-border">Top Sale News</h2>
                        <!-- End .title -->

                        <div class="owl-carousel owl-simple owl-nav-top carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
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
                                "1200": {
                                    "items":4
                                }
                            }
                        }'>

                        @if ($recentVipSaleNews->isNotEmpty() || $olderVipSaleNews->isNotEmpty())
                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(-237px, 0px, 0px); transition: all; width: 1188px;">
                                @foreach ($recentVipSaleNews as $item)
                                    <div class="owl-item" style="width: 217.6px; margin-right: 20px;">
                                        <div class="product">
                                            <figure class="product-media">
                                                <span class="product-label label-top">Top</span>
                                                <a href="product.html">
                                                    @if ($item->images->isNotEmpty())
                                                        <img src="{{ $item->images->first()->image_name }}"
                                                            alt="Image" class="equal-height-image">
                                                    @endif
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#"
                                                        class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                            to
                                                            wishlist</span></a>
                                                </div>
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                </div>
                                                <h3 class="product-title text-truncate-3">
                                                    <a href="product.html">{{ $item->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    ${{ number_format($item->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                    
                                @foreach ($olderVipSaleNews as $item)
                                    <div class="owl-item" style="width: 217.6px; margin-right: 20px;">
                                        <div class="product">
                                            <figure class="product-media">
                                                <span class="product-label label-top">Top</span>
                                                <a href="product.html">
                                                    @if ($item->images->isNotEmpty())
                                                        <img src="{{ $item->images->first()->image_name }}"
                                                            alt="Image" class="equal-height-image">
                                                    @endif
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#"
                                                        class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                            to
                                                            wishlist</span></a>
                                                </div>
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                </div>
                                                <h3 class="product-title text-truncate-3">
                                                    <a href="product.html">{{ $item->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    ${{ number_format($item->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <!-- Hiển thị owl-nav nếu có sản phẩm -->
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev" style="left: -20px; ">
                                <i class="icon-angle-left"></i>
                            </button>
                            <button type="button" role="presentation" class="owl-prev disabled" style="left: -20px; ">
                                <i class="icon-angle-left"></i>
                            </button>
                        </div>
                    @endif
                    
                            <style>
                                .text-truncate-3 {
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    line-height: 1.2em;
                                    /* Adjust as needed */
                                    max-height: 3.6em;
                                    /* 1.2em * 3 lines */
                                }

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

                                .owl-simple .owl-nav .owl-prev {
                                    left: -20px
                                }
                            </style>

                            <div class="owl-dots disabled"></div>
                        </div>
                        <!-- End .owl-carousel -->

                        <div class="mb-4"></div>
                        <!-- End .mb-4 -->

                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    {{ $totalNonVipSaleNews }} Products found
                                </div>
                                <!-- End .toolbox-info -->
                            </div>
                            <!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- End .toolbox-sort -->
                            </div>
                            <!-- End .toolbox-right -->
                        </div>
                        <!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row">
                                @forelse ($nonVipSaleNews as $item)
                                    <div class="col-6 col-md-4 col-xl-3">
                                        <div class="product">
                                            <figure class="product-media">
                                                <span class="product-label label-top">Top</span>
                                                <a href="product.html">
                                                    @if ($item->images->isNotEmpty())
                                                        <img src="{{ $item->images->first()->image_name }}" alt="Image"
                                                            class="equal-height-image">
                                                    @else
                                                        <img src="/path/to/default-image.jpg" alt="Default Image"
                                                            class="equal-height-image">
                                                    @endif
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    @if ($item->categoryToSubcategory)
                                                        <a
                                                            href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                    @else
                                                        <span>Uncategorized</span>
                                                    @endif
                                                </div>
                                                <h3 class="product-title text-truncate-3">
                                                    <a href="product.html">{{ $item->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    ${{ number_format($item->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p>No products found.</p>
                                    </div>
                                @endforelse
                            </div>


                            @if ($nonVipSaleNews->hasPages())
                                <ul class="pagination justify-content-center">
                                    {{-- Nút Previous --}}
                                    @if ($nonVipSaleNews->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-prev" href="#" aria-label="Previous"
                                                tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-link-prev"
                                                href="{{ $nonVipSaleNews->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Các số trang --}}
                                    @foreach ($nonVipSaleNews->getUrlRange(1, $nonVipSaleNews->lastPage()) as $page => $url)
                                        @if ($page == $nonVipSaleNews->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <a class="page-link" href="#">{{ $page }}</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Hiển thị tổng số trang --}}
                                    <li class="page-item-total">of {{ $nonVipSaleNews->lastPage() }}</li>

                                    {{-- Nút Next --}}
                                    @if ($nonVipSaleNews->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-link-next"
                                                href="{{ $nonVipSaleNews->nextPageUrl() }}" aria-label="Next">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-next" href="#" aria-label="Next"
                                                tabindex="-1" aria-disabled="true">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif

                            <!-- End .row -->
                        </div>
                        <!-- End .products -->

                    </div>
                    <!-- End .col-lg-9 -->

                    <aside class="col-lg-3 col-xl-5col order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-6" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Location
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-6">
                                    <div class="widget-body">
                                        <input type="text" class="form-control" />
                                        <select class="form-select form-control" aria-label="Default select example">
                                            <option selected>City</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <select class="form-select form-control" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <select class="form-select form-control" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Category
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <select class="form-select form-control" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range">$0 - $500</span>
                                            </div>
                                            <!-- End .filter-price-text -->

                                            <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal">
                                                <div class="noUi-base">
                                                    <div class="noUi-connects">
                                                        <div class="noUi-connect"
                                                            style="transform: translate(0%, 0px) scale(0.5, 1);"></div>
                                                    </div>
                                                    <div class="noUi-origin"
                                                        style="transform: translate(-100%, 0px); z-index: 5;">
                                                        <div class="noUi-handle noUi-handle-lower" data-handle="0"
                                                            tabindex="0" role="slider" aria-orientation="horizontal"
                                                            aria-valuemin="0.0" aria-valuemax="300.0" aria-valuenow="0.0"
                                                            aria-valuetext="$0">
                                                            <div class="noUi-touch-area"></div>
                                                            <div class="noUi-tooltip">$0</div>
                                                        </div>
                                                    </div>
                                                    <div class="noUi-origin"
                                                        style="transform: translate(-50%, 0px); z-index: 6;">
                                                        <div class="noUi-handle noUi-handle-upper" data-handle="1"
                                                            tabindex="0" role="slider" aria-orientation="horizontal"
                                                            aria-valuemin="200.0" aria-valuemax="1000.0"
                                                            aria-valuenow="500.0" aria-valuetext="$500">
                                                            <div class="noUi-touch-area"></div>
                                                            <div class="noUi-tooltip">$500</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End #price-slider -->
                                        </div>
                                        <!-- End .filter-price -->
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                        </div>
                        <!-- End .sidebar sidebar-shop -->
                    </aside>
                    <!-- End .col-lg-3 -->
                </div>
            </div>
        </div>
    </main>
@endsection
