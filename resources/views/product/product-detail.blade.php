@extends('layouts.client_layout')
@section('content')
<main class="main">
    {{-- <script> console.table(@json($product));</script> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>

            <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ asset($product->firstImage->image_name) }} "
                                        data-zoom-image="{{ asset($product->firstImage->image_name) }}"
                                        alt="product image">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>

                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">


                                    @foreach ($product->images as $item)
                                    <a class="product-gallery-item {{ $loop->first ? 'active' : '' }}" href="#"
                                    data-image="{{ asset($item->image_name) }}"
                                    data-zoom-image="{{ asset($item->image_name) }}">
                                    <img src="{{ asset($item->image_name) }}" alt="product side">
                                     </a>
                                    @endforeach


                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->name_product }}</h1>
                            <!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews
                                    )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price"  id="price">
                                ${{ $product->price }}
                            </div><!-- End .product-price -->



                            @if(isset($variants))
                            @foreach($variants as $variant)

                            @if(strtolower($variant->name) === 'color'|| strtolower($variant->name) === 'ram' || strtolower($variant->name) === 'rom')
                            <div class="details-filter-row details-row-size">
                                <label>{{ $variant->name }}:</label>
                                <div class="product-size">
                                    @foreach($variant->options as $item)
                                    <a class="checka checka-{{ strtolower($variant->name)  }} {{ $loop->first ? 'active' : '' }}" id="{{ strtolower($variant->name) }}" data-type="{{ strtolower($variant->name) }}" data-value="{{ $item }}"  value="{{ $item }}" >
                                        {{ $item }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif

                            @if(isset($variants))
                            @foreach($variants as $variant)
                            @if(strtolower($variant->name) === 'size')
                            <div class="details-filter-row details-row-size">
                                <label>{{ $variant->name }}:</label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="checka1 form-control">
                                        {{-- <option value="#" selected="selected">Select a size</option> --}}
                                        @foreach($variant->options as $item)
                                            <option id="size" data-value="{{ $item }}" data-type="{{ strtolower($variant->name) }}" class="checka1 {{ $loop->first ? 'active' : '' }}" value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    </div><!-- End .select-custom -->
                                    {{-- <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a> --}}
                                </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1"  min="1"
                                        max="{{ $product->quantity }}" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to
                                            Wishlist</span></a>
                                    <a href="#" class="btn-product " title="Compare"><i class="fa-regular fa-envelope"></i><span style="padding-left: 10px"> Contact the seller</span></a>
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="#">{{ $product->subcategory->name_sub_category }}</a>,
                                    <a href="#">{{ $product->subcategory->name_category }}</a>,

                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                            class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                            class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                            role="tab" aria-controls="product-info-tab" aria-selected="false">Additional
                            information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                            href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                            aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab"
                            href="#product-review-tab" role="tab" aria-controls="product-review-tab"
                            aria-selected="false">Reviews (2)</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                        aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                         <h3>Information</h3>
                        {!! $product->description !!}
                                @if(isset($variants->variants))
                                @foreach($variants->variants as $variant)
                                <h3>{{ $variant->name }}</h3>
                                <ul>
                                @foreach($variant->options as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                                @endforeach
                                @endif

                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the
                                delivery options we offer, please view our <a href="#">Delivery
                                    information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you
                                can do so within a month of receipt. For full details of how to make a return,
                                please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews (2)</h3>
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">Samanta J.</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">6 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Good, perfect size</h4>

                                        <div class="review-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus
                                                cum dolores assumenda asperiores facilis porro reprehenderit
                                                animi culpa atque blanditiis commodi perspiciatis doloremque,
                                                possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">5 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Very good</h4>

                                        <div class="review-content">
                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum
                                                blanditiis laudantium iste amet. Cum non voluptate eos enim, ab
                                                cumque nam, modi, quas iure illum repellendus, blanditiis
                                                perspiciatis beatae!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
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
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-4.jpg') }}" alt="Product image"
                                class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare"
                                title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Women</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Brown paperbag waist <br>pencil
                                skirt</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            $60.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="{{ asset('assets/images/products/product-4-thumb.jpg') }}" alt="product desc">
                            </a>
                            <a href="#">
                                <img src="{{ asset('assets/images/products/product-4-2-thumb.jpg') }}" alt="product desc">
                            </a>

                            <a href="#">
                                <img src="{{ asset('assets/images/products/product-4-3-thumb.jpg') }}" alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-out">Out of Stock</span>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-6.jpg') }}" alt="Product image"
                                class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare"
                                title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jackets</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Khaki utility boiler jumpsuit</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">$120.00</span>
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 6 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-top">Top</span>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-11.jpg') }}" alt="Product image"
                                class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare"
                                title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Shoes</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Light brown studded Wide fit wedges</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            $110.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 1 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="{{ asset('assets/images/products/product-11-thumb.jpg') }}" alt="product desc">
                            </a>
                            <a href="#">
                                <img src="{{ asset('assets/images/products/product-11-2-thumb.jpg') }}" alt="product desc">
                            </a>

                            <a href="#">
                                <img src="{{ asset('assets/images/products/product-11-3-thumb.jpg') }}" alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-10.jpg') }}" alt="Product image"
                                class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare"
                                title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jumpers</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Yellow button front tea top</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            $56.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 0 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-7.jpg') }}" alt="Product image"
                                class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare"
                                title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Jeans</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">Blue utility pinafore denim dress</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            $76.00
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<!-- Sticky Bar -->
<div class="sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="{{ asset($product->firstImage->image_name) }}" alt="Product image">
                    </a>
                </figure><!-- End .product-media -->
                <h4 class="product-title"><a href="product.html">{{ $product->name_product }}</a></h4>
                <!-- End .product-title -->
            </div><!-- End .col-6 -->

            <div class="col-6 justify-content-end">
                <div class="product-price" id="index-price" >

                </div><!-- End .product-price -->
                <div class="product-details-quantity">
                    <input type="number" id="sticky-cart-qty" class="form-control" value="1" min="1" max="{{ $product->quantity }}"
                        step="1" data-decimals="0" required>
                </div><!-- End .product-details-quantity -->

                <div class="product-details-action">
                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                </div><!-- End .product-details-action -->
            </div><!-- End .col-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .sticky-bar -->

@endsection

@section('script-link-css')

<script>
    $(document).ready(function() {



        var selectedVariants = {};
        var valuesArray = {};
             getActiveData();
            console.log(selectedVariants);

        var variantDataDetails = @json($variant_data_details);
        // $('#qty').change(function() {
        //     getActiveData();
        // });
            $('.checka').click(function() {

                let variantType = $(this).data('type');
                let selectedItem = $(this).data('value');
                 $('.checka-'+ variantType).removeClass('active');
                 $(this).addClass('active');
                 selectedVariants[variantType] = selectedItem;
                console.log('Selected variants:', selectedVariants);


                 updatePrice();
                 getActiveData();
                });
                $('#size').change(function() {
                let selectedSize = $(this).val();
                selectedVariants['size'] = selectedSize;
                console.log('Selected variants:', selectedVariants);

                updatePrice();
                getActiveData();

            });

            var hasSelectedVariants = false;
            var hasSelectedVariants1 = false;

            function updatePrice() {
                var selectedVariant = [];
                var price = {{ $product->price }};
                for (const [key, value] of Object.entries(selectedVariants)) {
                    if (value) {
                        selectedVariant.push({key: key, value: value});
                    }
                }

                    // Tạo một hàm để tạo ra các kết hợp
                    function getPermutations(arr) {
                        let result = [];

                        if (arr.length === 1) {
                            return [arr.map(item => item.value)];
                        }
                        for (let i = 0; i < arr.length; i++) {
                            let current = arr[i].value;
                            let remaining = arr.slice(0, i).concat(arr.slice(i + 1));
                            let remainingPerms = getPermutations(remaining);
                            for (let j = 0; j < remainingPerms.length; j++) {
                                result.push([current].concat(remainingPerms[j]));
                            }
                        }
                            return result;
                    }
                    // Hàm kết hợp các hoán vị với dấu '-'
                    function generateCombinations(arr) {
                        let permutations = getPermutations(arr);
                        let result = [];
                        permutations.forEach(perm => {
                            result.push(perm.join('-'));
                        });
                        return result;
                    }
                var combinations = generateCombinations(selectedVariant);
                    console.log(combinations);


                    combinations.forEach(function(combination) {
                        variantDataDetails.forEach(function(variant) {
                            if (variant.name === combination) {
                                variant.options.forEach(function(option) {
                                    if (option.name === 'price') {
                                       price = parseFloat(option.value);
                                    }
                                });
                            }
                            $('#price').text('$' + price.toFixed(2));
                        });
            });


            }
        function getActiveData() {

                // Duyệt qua tất cả các phần tử có class 'checka' và class 'active'
                $('.checka.active').each(function() {
                    let type = $(this).data('type');
                    let value = $(this).data('value');

                    if (!hasSelectedVariants) {
                        selectedVariants[type] = value;

                        console.log(`Dòng này chỉ chạy một lần: ${type} = ${value}`);
                        hasSelectedVariants = true;
                    }

                    let productPrice = $('#price').text().replace('$', '').trim();
                    let  stock = $('#qty').val();
                    let  size = $('#size').val();
                    if ($('#size').length) {
                        valuesArray['size'] = size ;
                        if (!hasSelectedVariants1) {
                        selectedVariants['size'] = size;
                        hasSelectedVariants1 = true; // Đánh dấu là đã chạy
                    }

                    }

                    // Thêm đối tượng vào mảng
                    valuesArray[type] = value;
                    valuesArray['price'] = productPrice ;
                    valuesArray['stock'] = stock ;

                });
                $('#index-price').html('$'+valuesArray['price']);



                console.log('valuesArray',valuesArray);
                // return valuesArray;
            }
            function syncStockValues() {
                let newStockValue = $('#qty').val();
                $('#sticky-cart-qty').val(newStockValue);
                valuesArray['stock'] = newStockValue;
            }
            function syncStickyStockValues() {
                let newStockValue = $('#sticky-cart-qty').val();
                $('#qty').val(newStockValue);
                valuesArray['stock'] = newStockValue;
            }

          $('#qty').on('input change', function() {
                syncStockValues();
            });

            // Khi người dùng thay đổi #sticky-cart-qty
            $('#sticky-cart-qty').on('input change', function() {
                syncStickyStockValues();
            });



        // Thay đổi hình ảnh chính khi bấm vào ảnh nhỏ
        $('.product-gallery-item').on('click', function(e) {
            e.preventDefault();
            // Lấy URL của ảnh từ thuộc tính data của ảnh nhỏ
            let newImage = $(this).data('image');
            let newZoomImage = $(this).data('zoom-image');
            // Thay đổi hình ảnh và ảnh phóng to của ảnh chính
            $('#product-zoom').attr('src', newImage).data('zoom-image', newZoomImage);
            // Xóa lớp active khỏi tất cả các ảnh nhỏ và thêm vào ảnh được bấm
            $('.product-gallery-item').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>


<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>


@endsection
