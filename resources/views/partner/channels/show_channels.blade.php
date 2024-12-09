@extends('layouts.client_layout')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
@section('content')
<main class="main">

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Channel</li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="page-content">

        <div class="container">
            <div class="row d-flex justify-content-Start">
                <div class="col col-md-9 col-lg-7 col-xl-6">
                    <div style="width:  fit-content;min-width:460px; ">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    @if ($channel->image_channel)
                                    <img src="{{ asset($channel->image_channel) }}" alt="{{ $channel->image_channel }}"
                                        class="img-fluid" style="width: 120px;  border-radius: 10px;">
                                    @else
                                    <img src="https://cdnphoto.dantri.com.vn/lWbNf1jAm5A1aQriE5UO0SAuuYg=/2024/01/15/co-gai-xinh-dep2-edit...78.jpeg"
                                        alt="Generic placeholder image" class="img-fluid"
                                        style="width: 120px;  border-radius: 10px;">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ $channel->name_channel }}</h5>
                                    <p style="color: #ff0000;position: relative; top:-8px;"><i
                                            class="fa-solid fa-handshake" style="color: #FFD43B;"></i>
                                        Trusted partners receive the protection of the floor
                                    </p>
                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-md-2 bg-body-tertiary  "
                                        style="width: fit-content">
                                        <div class="mx-3">
                                            <p class="small text-muted "> <i class="fa-solid fa-location-dot"
                                                    style="color: #74C0FC;"></i> {{ $channel->address }} </p>
                                            <p class="small text-muted"><i class="fa-solid fa-clock"
style="color: #74C0FC;"></i>
                                                {{ $channel->created_at->format('d-m-Y') }}</p>
                                            {{--
                                    <p class="small text-muted "><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> 56</p>
                                    --}}
                                        </div>
                                        <div>
                                            <p class="small text-muted "><i class="fa-solid fa-users"
                                                    style="color: #74C0FC;"></i> {{ $channel->followers_count }} </p>
                                            <p class="small text-muted "> <i class="fa-solid fa-clipboard-check"
                                                    style="color: #74C0FC;"></i> {{ $NewsCount }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset(auth()->user()->user_id))
                @if(!(auth()->user()->user_id == $channel->user_id))
                <div class="col col-md-9 col-lg-7 col-xl-6 d-flex justify-content-end">
                    @if ($isFollowed)
                    <form id="unfollow-form" action="{{ route('unfollow.channel', $channel->channel_id) }}"
                        method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded mt-md-3 mx-md-3" style="height: 50px"><i
                                class="fa-solid fa-user-minus me-2"></i>Unfollow</button>
                    </form>
                    @else
                    <form id="follow-form" action="{{ route('follow.channel', $channel->channel_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-rounded mt-md-3 mx-md-3"
                            style="height: 50px"><i class="fa-solid fa-user-plus"></i> Follow</button>
                    </form>
                    @endif
                </div>
                @endif
                @endif
            </div>


            <div class="col-md-12">
                <ul class="nav justify-content-center nav-tabs" id="tabs-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active Bage text-uppercase" id="tab-5-tab" data-toggle="tab" href="#tab-5"
                            role="tab" aria-controls="tab-5" aria-selected="true">Sale
                            News({{$sale_news->where('status', 1)->count()}}
                            )</a>
                    </li>
                    <li class="nav-item">
<a class="nav-link text-uppercase" id="tab-6-tab" data-toggle="tab" href="#tab-6" role="tab"
                            aria-controls="tab-6" aria-selected="false">Infomation Channel
                            ( {{$sale_news->where('status', 0)->count()}}
                            )</a>
                    </li>

                </ul>
                <div class="tab-content tab-content-border" id="tab-content-2">
                    <div class="tab-pane fade active show" id="tab-5" role="tabpanel" aria-labelledby="tab-5-tab">

                        <div class="row d-flex"> 
                        @if($sale_news->isNotEmpty())
                        
                            <div class="col-lg-9">
                                <div class="toolbox">
                                    <div class="toolbox-left">
                                        <div class="toolbox-info">
                                            Showing <span>{{ $productCount }}</span> Products
                                        </div>
                                        <!-- End .toolbox-info -->
                                    </div>
                                    <!-- End .toolbox-left -->
                                    <div class="toolbox-right" style="visibility: hidden;">
                                        <div class="toolbox-sort">
                                            <div class="select-custom">
                                                <select name="sortby" id="sortby" class="form-control">
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
                                    @foreach ($sale_news as $sale_new)
                                    <div class="product product-list">
                                        <div class="row">
                                            <div class="col-6 col-lg-3">
                                                <figure class="product-media">
                                                    @if($sale_new->vip_package_id != null)
                                                    <span class="product-label label-new">On top</span>
                                                    @endif
                                                    <img src="{{ asset($sale_new->firstImage->image_name) }}"
                                                        alt="Product image1" class="product-image">
                                                </figure>
</div>
                                            <div class="col-6 col-lg-3 order-lg-last">
                                                <div class="product-list-action">
                                                    <div class="product-price">
                                                        <h4 class="text-primary">${{ $sale_new->price }}</h4>
                                                    </div>
                                                    <div class="product-actions">
                                                        <form action="{{ route('toggleWishlist') }}" method="POST"
                                                            class="wishlist-form"
                                                            data-id="{{ $sale_new->sale_new_id }}">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-light mb-2 wishlist-btn {{ $sale_new->isFavorited ? 'text-primary' : '' }} color-danger"
                                                                title="{{ $sale_new->isFavorited ? 'Remove from wishlist' : 'Add to wishlist' }}">
                                                                <i class="fas fa-heart"></i>
                                                                {{ $sale_new->isFavorited ? 'Added to wishlist' : 'Add to wishlist' }}
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('salenew.detail', $sale_new->sale_new_id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa-solid fa-eye"></i> Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="product-body product-action-inner">
                                                    <div class="product-cat">
                                                        <a href="#">{{ $sale_new->name_sub_category }}</a>
                                                    </div>
                                                    <h3 class="product-title">{{ $sale_new->title }}</h3>
                                                    <div class="product-content wrap">
                                                        <p class="text-truncate">{{ $sale_new->description }}</p>
                                                    </div>
<div class="product-description">
                                                        <p><i class="fas fa-map-marker-alt" style="color: #74C0FC;"></i>
                                                            {{ $sale_new->address }}</p>
                                                        <p><i class="fas fa-calendar-alt" style="color: #74C0FC;"></i>
                                                            {{ $sale_new->created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Pagination -->
                                    <div>
                                        {{ $sale_news->links() }}
                                    </div>
                                </div>
                                <!-- End .products -->
                            </div>
                         
                        @else
                        <div class="col-lg-9 text-center d-flex justify-content-center align-items-center">
            <div>
                @if(request()->has('keyword') || request()->has('category'))
                    <h4>No products matched your search criteria.</h4>
                    <p>Please try different keywords or categories.</p>
                @else
                    <h4>There are currently no products in this store.</h4>
                    <p>Please come back later or check other stores.</p>
                @endif
            </div>
        </div>
                        @endif
                        <!-- End .col-lg-9 -->
                        @if(count($all_sales) > 0)
                           <aside class="col-lg-3 col-xl-5col order-lg-first">
                            <div class="sidebar sidebar-shop">
                                <form method="POST"
                                    action="{{ route('search_channel', ['id' => $channel->channel_id]) }}">
                                    @csrf
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-2" role="button"
                                                aria-expanded="true" aria-controls="widget-2">
                                                Category
                                            </a>
                                        </h3>
                                        <div class="collapse show" id="widget-2">
                                            <div class="widget-body">
                                                <select class="form-select form-control filter-input" name="category">
                                                   <option value="">Select Category</option>
                                                    @if(isset($category) && $category->count())
                                                    @foreach ($category as $item)
                                                    <option value="{{ $item->category_id }}"
                                                        {{ old('category') == $item->category_id ? 'selected' : '' }}>
                                                        {{ $item->name_category }}
                                                    </option>
                                                    @endforeach
                                                    @else
                                                    <p>No categories available.</p>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget widget-collapsible mr-4">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-5" role="button"
                                                aria-expanded="true" aria-controls="widget-5">
                                                Price
                                            </a>
                                        </h3>
                                        <div class="collapse show" id="widget-5">
                                            <div class="widget-body">
                                                <div class="filter-price">
                                                    <div class="filter-price-text">
                                                        Price Range:
                                                        <span id="filter-price-range">
                                                            ${{ request()->get('minPrice', 0) }} -
                                                            ${{ request()->get('maxPrice', $maxPriceRange) }}
                                                        </span>
                                                    </div>
                                                    <div id="price-slider"></div>
                                                    <input type="hidden" id="minPrice" name="minPrice"
                                                        value="{{ request()->get('minPrice', 0) }}">
                                                    <input type="hidden" id="maxPrice" name="maxPrice"
                                                        value="{{ request()->get('maxPrice', $maxPriceRange) }}">
                                                </div>
                                            </div>
                                        </div>
</div>
                                    <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}"
                                        placeholder="Search ..." />
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                </form>

                            </div>
                            <!-- End .sidebar sidebar-shop -->
                        </aside>
                        @endif

                        </div>

                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tab-6-tab">
                        @if(isset($information->about))
                        <div class="mb-2">
                            {!! $information->about !!}
                        </div>
                        @else
                        <p class="text-muted">No information available.</p>
                        @endif

                        <div class="row">
                            @if(isset($information->banner_url))
                            <img src="{{ asset('storage/' . $information->banner_url) }}" alt="Banner">
                            @else
                            <p class="text-muted">No banner image available.</p>
                            @endif

                        </div><!-- .End .tab-pane -->


                    </div><!-- End .tab-content -->
                </div>
            </div>
        </div>

    </div>


</main><!-- End .main -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var userId = "{{ Auth::check() ? Auth::user()->user_id : '' }}";
$(document).ready(function() {
    if (typeof noUiSlider === 'object') {
        var priceSlider = document.getElementById('price-slider');
        if (priceSlider == null) return;
        noUiSlider.create(priceSlider, {
            start: [0, <?php echo $maxPriceRange; ?>],
            connect: true,
            step: 50,
            margin: 200,
            range: {
                'min': 0,
                'max': <?php echo $maxPriceRange; ?>
            },
            tooltips: true,
            format: wNumb({
                decimals: 0,
                prefix: '$'
            })
        });
        priceSlider.noUiSlider.on('update', function(values, handle) {
            $('#filter-price-range').text(values.join(' - '));
            const minInput = document.getElementById('minPrice');
            const maxInput = document.getElementById('maxPrice');
            const minValue = values[0].replace('$', '');
            const maxValue = values[1].replace('$', '');
            if (minInput && maxInput) {
                minInput.value = minValue;
                maxInput.value = maxValue;
            }
        });
    }
})
</script>

<script src="{{ asset('assets/js/ajax_wishlist.js') }}"></script>
<script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
@endsection
