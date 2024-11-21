@extends('layouts.client_layout')


@section('content')

<main class="main">
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
                                    <img id="product-zoom" src="{{ asset($new->firstImage->image_name) }} "
                                        data-zoom-image="{{ asset($new->firstImage->image_name) }}"
                                        alt="product image">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>

                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">


                                    @foreach ($new->images as $item)
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
                            <h1 class="product-title">{{ $new->title }}</h1><!-- End .product-title -->
                            <div class="product-price">
                                $ {{ number_format($new->price, 2) }}
                            </div><!-- End .product-price -->

                            <div class="product-content">
                               <p> <i class="fa-solid fa-location-dot"></i>  {{ $new->address }} </p>
                               <p> <i class="fa-solid fa-clock"></i>  <span id="time-ago"></span> </p>
                            </div><!-- End .product-content -->



                            <div class="mb-2">

                            @if ($get_user->phone_number)
                            <a href="#" class="btn btn-outline-dark btn-rounded mr-4"><i class="fa-solid fa-phone"></i> {{ $get_user->phone_number }}</a>
                            @endif
                            @if(isset(auth()->user()->user_id))
                            <a id="message-id" href=""  data-id="{{$new->user_id}}" data-name="{{ $get_user->full_name}}"  class="btn btn-primary btn-rounded"> <i class="fa-regular fa-comments"></i>  Message the seller </a>
                            @endif
                                </div>



                            @if(!is_null($new->channel_id))


                            <div class="product-details-footer">
                                <div class="container summary">

                                <div class="row  px-4">
                                    <div class="col-2">

                                        <img src="{{ asset($new->channel->image_channel) }}" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">

                                    </div>
                                    <div class="col-9 col-md-6">
                                        <h6 >{{ $new->channel->name_channel }} <i class="fa-solid fa-circle-check" style="color: #74C0FC;"></i></h6>
                                         <i class="fa-solid fa-shop" style="color: #74C0FC;"></i><span class="mx-2 summary-title" style="color: #74C0FC ">Trusted partner</span>

                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('channels.show',$new->channel_id) }}" class="btn btn-primary mt-3 mt-md-0 ms-2"><i class="fa-solid fa-eye"></i> Visit</a>
                                    </div>
                                    </div>
                                    <div class="row pt-2 px-5 ">
                                        <p class="col-6"> <i class="fa-brands fa-product-hunt" style="color: #74C0FC;"></i> {{ $data_count_news }} Selling news <br>
                                            <i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> {{ $data_count_news_sold }} Sold<br>
                                        </p>
                                        <p class="col-6"> <i class="fa-regular fa-face-smile" style="color: #74C0FC;"></i> Positive feedback<br>
                                            <i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> Deposited  <br>
                                        </p>


                                    </div>


                                </div>
                            </div>
                            @else

                                <div class="product-details-footer">
                                <div class="container summary">

                                <div class="row  px-4">
                                                <div class="col-2">
                                                    @if ($get_user->image_user)
                                                    <img src="{{ asset($get_user->image_user) }}" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">
                                                    @else
                                                    <img src="https://ispacedanang.edu.vn/wp-content/uploads/2024/05/hinh-anh-dep-ve-hoc-sinh-cap-3-1.jpg" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">
                                                    @endif
                                    </div>
                                    <div class="col-9 col-md-10">
                                        <h6 > {{ $get_user->full_name }} <i class="fa-solid fa-user mx-3" style="color: #74C0FC;"></i></h6>
                                        <i class="fa-solid fa-circle-exclamation" style="color: #e90707;"></i><span class="mx-2 " style="color: #e90707 ">Please pay attention when trading products that do not receive the protection of the exchange !</span>

                                    </div>




                                        </div>
                                    </div>
                                </div>

                                @endif
                            <!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->



            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Detailed information</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Sale News Information</h3>
                            <p> {{ $new->description }}</p>


                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>

                            {{-- <h3>Fabric & care</h3> --}}



                                {{-- @if(isset($variants))
                                <ul>
                                @foreach($variants as $variant)

                                @foreach($variant->options as $item)
                                <li>{{ $variant->name }}-{{ $item }}</li>
                                @endforeach
                                @endforeach
                            </ul>
                                @endif --}}


                            <h3>Size</h3>
                            <p>one size</p>
                        </div><!-- End .product-desc-content -->
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

                @foreach ($get_data_7subcategory as $item )


                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-new">Operation</span>
                        <a href="product.html">
                            <img src="{{ asset($item->firstImage->image_name) }}" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div><!-- End .product-action-vertical -->


                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        {{-- <div class="product-cat">
                            <a href="#">Women</a>
                        </div><!-- End .product-cat --> --}}
                        <h3 class="product-title"><a href="product.html">{{ $item->title }}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            ${{ $item->price }}
                        </div><!-- End .product-price -->



                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach


            </div><!-- End .owl-carousel -->

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>

    const postTime = new Date('{{ $new->created_at }}');
    function timeSince(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) {
            return Math.floor(interval) + " year";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
            return Math.floor(interval) + " month";
        }
        interval = seconds / 86400;
        if (interval > 1) {
            return Math.floor(interval) + "  days";
        }
        interval = seconds / 3600;
        if (interval > 1) {
            return Math.floor(interval) + " hour";
        }
        interval = seconds / 60;
        if (interval > 1) {
            return Math.floor(interval) + " minutes";
        }
        return Math.floor(seconds) + " seconds";
    }
    document.getElementById("time-ago").textContent = timeSince(postTime);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        @if (isset(auth()->user()->user_id))
    // message
    var recipientId = null;
    var currentChannel = null;
    var recipientName = null;
    var login_userId = {{ auth()->user()->user_id }};
    $('#message-id').click(function(){
        recipientId = $(this).attr('data-id');
        recipientName = $(this).attr('data-name');

        $.ajax({
              url: "{{ route('message.checkconversations') }}",
              method: 'GET',
              data: { recipientId: recipientId },
              success: function(response) {
                  if (response.channelExists) {
                    //   subscribeToChannel(response.channelName);
                      localStorage.setItem('channelName', response.channelName);
                      localStorage.setItem('recipientName', recipientName);
                      window.location.href = '{{ asset('message/conversations') }}';

                  } else {
                      createNewChannel(recipientId);

                  }
              },
              error: function(xhr, status, error) { console.error(error); }
          });
    });
    function createNewChannel(recipientId) {

        $.ajax({
            url: '{{ route('message.createconversations') }}',
            method: 'GET',
            data: { recipientId: recipientId },
            success: function (response) {
                if(response.success == true){

                localStorage.setItem('channelName', response.channelName);
                localStorage.setItem('recipientName', recipientName);
                window.location.href = '{{ asset('message/conversations') }}';
                }
                else{

                console.log(response.error);
                }
            },

        });
        }
    @endif
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


@endsection
