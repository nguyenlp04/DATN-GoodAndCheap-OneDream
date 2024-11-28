@extends('layouts.client_layout')
@section('content')

</style>

<main class="container mb-5">

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Channel</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    {{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif --}}

    <div class="row d-flex justify-content-start">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div style="width: fit-content; min-width: 460px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            @if ($channels->image_channel)
                            <img src="{{ asset($channels->image_channel) }}"
                                alt="Generic placeholder image" class="img-fluid" style="width: 120px; border-radius: 10px;">
                            @else
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                alt="Generic placeholder image" class="img-fluid" style="width: 120px; border-radius: 10px;">
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1">{{ $channels->name_channel }}</h3>
                            <p style="color: #ff0000;"><i class="fa-solid fa-handshake" style="color: #FFD43B;"></i>
                                Trusted partners receive the protection of the floor
                            </p>
                            <div class="d-flex justify-content-start rounded-3 p-2 mb-md-2 bg-body-tertiary" style="width: fit-content">
                                <div class="mx-3">
                                    <p class="small text-muted"><i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i> {{ $channels->address }}</p>
                                    <p class="small text-muted"><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $channels->created_at }}</p>
                                </div>
                                <div>
                                    <p class="small text-muted"><i class="fa-solid fa-users" style="color: #74C0FC;"></i> {{ $channels->followers_count }}</p>
                                    <p class="small text-muted"><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> {{ $NewsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!(auth()->user()->user_id == $channels->user_id))
        <div class="col col-md-9 col-lg-7 col-xl-6 d-flex justify-content-end">
            @if ($isFollowed)
            <form id="unfollow-form" action="{{ route('unfollow.channel', $channels->channel_id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-rounded mt-md-3 mx-md-3" style="height: 50px"><i class="fa-solid fa-user-minus me-2"></i>Unfollow</button>
            </form>
            @else
            <form id="follow-form" action="{{ route('follow.channel', $channels->channel_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-rounded mt-md-3 mx-md-3" style="height: 50px"><i class="fa-solid fa-user-plus"></i> Follow</button>
            </form>
            @endif
        </div>
        @endif
    </div>
    <br>    
    <ul class="nav nav-tabs justify-content-center mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#sale-new">Sale-New</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#channel-info">Information</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="sale-new" role="tabpanel">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right" style="visibility: hidden;">
                            <div class="toolbox-sort">
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        @if($sale_news->total() > 0)
                        @foreach ($sale_news as $sale_new)
                        <div class="product product-list">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <figure class="product-media">
                                        @if($sale_new->vip_pakage_id != null)
                                        <span class="product-label label-new">
                                            On top
                                        </span>
                                        @endif
                                        <img src="{{ asset($sale_new->firstImage->image_name) }}" alt="Product image1" class="product-image">
                                    </figure><!-- End .product-media -->
                                </div><!-- End .col-sm-6 col-lg-3 -->

                                <div class="col-6 col-lg-3 order-lg-last">
                                    <div class="product-list-action">
                                        <div class="product-price">
                                            <h4 class="text-primary">${{ $sale_new->price }}</h4>
                                        </div><!-- End .product-price -->
                                        <div class="product-actions">
                                            <a href="#" class="btn btn-light mb-2" title="Add to Wishlist">
                                                <i class="fas fa-heart"></i> Wishlist
                                            </a>
                                            <a href="{{ route('salenew.detail', $sale_new->sale_new_id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-eye"></i> Details
                                            </a>
                                        </div>
                                    </div><!-- End .product-list-action -->
                                </div><!-- End .col-sm-6 col-lg-3 -->

                                <div class="col-lg-6">
                                    <div class="product-body product-action-inner">
                                        <div class="product-cat">
                                            <a href="#">{{ $sale_new->name_sub_category }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title">{{ $sale_new->title }}</h3><!-- End .product-title -->
                                        <div class="product-content wrap">
                                            <p class="text-truncate">{{ $sale_new->description }}</p>
                                        </div><!-- End .product-content -->
                                        <div class="product-description">
                                            <p><i class="fas fa-map-marker-alt" style="color: #74C0FC;"></i> {{ $sale_new->address }}</p>
                                            <p><i class="fas fa-calendar-alt" style="color: #74C0FC;"></i> {{ $sale_new->created_at }}</p>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .product -->
                        @endforeach
                        <div class="d-flex justify-content-center">{{ $sale_news->links() }}</div>
                        @else
                        <p>Không có sản phẩm nào để hiển thị.</p>
                        @endif
                    </div><!-- End .products -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3><!-- End .widget-title -->
                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        @foreach($subcategory_count as $name => $count)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ Str::slug($name) }}" value="{{ $name }}">
                                                <label class="custom-control-label" for="{{ Str::slug($name) }}">
                                                    <p>{{ $name }}</p>
                                                </label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{ $count }}</span>
                                        </div><!-- End .filter-item -->
                                        @endforeach
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3><!-- End .widget-title -->
                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-7">
                                                <label class="custom-control-label" for="brand-7">Nike</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Price
                                </a>
                            </h3><!-- End .widget-title -->
                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->
                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .tab-pane -->

        <div class="tab-pane fade" id="channel-info">
            <div class="content-section bg-white p-4 shadow-sm rounded">
                <h4 class="text-primary">About Us</h4>
                <p class="text-muted">
                    @if ($channels->info && $channels->info->about)
                    {!! $channels->info->about !!}
                    @else
                    <span>No information available.</span>
                    @endif
                </p>

                <h4 class="text-primary mt-4">Gallery</h4>
                @if ($channels->info && $channels->info->banner_url)
                <img src="{{ asset('storage/' . $channels->info->banner_url) }}" class="img-fluid rounded" alt="Store Banner">
                @else
                <p>No banner available for this channel.</p>
                @endif
            </div>
        </div>
        
        
        
        
        
    </div><!-- End .tab-content -->

</main>


@endsection