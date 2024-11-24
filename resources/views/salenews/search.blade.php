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
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-2 col-xl-4-5col px-3">
                    <div class="mb-2"></div>
                    <!-- End .mb-2 -->

                    <h2 class="title title-border">Top Sale News</h2>
                    <!-- End .title -->

                    <div
                        class="owl-carousel owl-simple owl-nav-top carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
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
                        }'
                    >

                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-237px, 0px, 0px); transition: all; width: 1188px;">
                                <div class="owl-item" style="width: 217.6px; margin-right: 20px;">
                                    <div class="product">
                                        <figure class="product-media">
                                            <span class="product-label label-top">Top</span>
                                            <a href="product.html">
                                                <img src="assets/images/demos/demo-13/products/product-7.jpg" alt="Product image" class="product-image" />
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>

                                            </div>
                                            <!-- End .product-action-vertical -->


                                            <!-- End .product-action -->
                                        </figure>
                                        <!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#">Laptops</a>
                                            </div>
                                            <!-- End .product-cat -->
                                            <h3 class="product-title"><a href="product.html">MacBook Pro 13" Display, i5</a></h3>
                                            <!-- End .product-title -->
                                            <div class="product-price">
                                                $1,199.00
                                            </div>
                                            <!-- End .product-price -->
                                        </div>
                                        <!-- End .product-body -->
                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev" style="left: -20px"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next disabled"><i class="icon-angle-right"></i></button>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                    <!-- End .owl-carousel -->

                    <div class="mb-4"></div>
                    <!-- End .mb-4 -->

                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                10 Products found
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



                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="product">
                                    <figure class="product-media">
                                        <span class="product-label label-top">Top</span>
                                        <a href="product.html">
                                            <img src="assets/images/demos/demo-13/products/product-7.jpg" alt="Product image" class="product-image" />
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>

                                        </div>
                                        <!-- End .product-action-vertical -->


                                        <!-- End .product-action -->
                                    </figure>
                                    <!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Laptops</a>
                                        </div>
                                        <!-- End .product-cat -->
                                        <h3 class="product-title"><a href="product.html">MacBook Pro 13" Display, i5</a></h3>
                                        <!-- End .product-title -->
                                        <div class="product-price">
                                            $1,199.00
                                        </div>
                                        <!-- End .product-price -->

                                        <!-- End .rating-container -->
                                    </div>
                                    <!-- End .product-body -->
                                </div>
                                <!-- End .product -->
                            </div>
                            <!-- End .col-sm-6 col-md-4 col-xl-3 -->



                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .products -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item-total">of 2</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- End .col-lg-9 -->

                <aside class="col-lg-3 col-xl-5col order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-6" role="button" aria-expanded="true" aria-controls="widget-5">
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
                                <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-5">
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
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
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
                                                <div class="noUi-connects"><div class="noUi-connect" style="transform: translate(0%, 0px) scale(0.5, 1);"></div></div>
                                                <div class="noUi-origin" style="transform: translate(-100%, 0px); z-index: 5;">
                                                    <div
                                                        class="noUi-handle noUi-handle-lower"
                                                        data-handle="0"
                                                        tabindex="0"
                                                        role="slider"
                                                        aria-orientation="horizontal"
                                                        aria-valuemin="0.0"
                                                        aria-valuemax="300.0"
                                                        aria-valuenow="0.0"
                                                        aria-valuetext="$0"
                                                    >
                                                        <div class="noUi-touch-area"></div>
                                                        <div class="noUi-tooltip">$0</div>
                                                    </div>
                                                </div>
                                                <div class="noUi-origin" style="transform: translate(-50%, 0px); z-index: 6;">
                                                    <div
                                                        class="noUi-handle noUi-handle-upper"
                                                        data-handle="1"
                                                        tabindex="0"
                                                        role="slider"
                                                        aria-orientation="horizontal"
                                                        aria-valuemin="200.0"
                                                        aria-valuemax="1000.0"
                                                        aria-valuenow="500.0"
                                                        aria-valuetext="$500"
                                                    >
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
