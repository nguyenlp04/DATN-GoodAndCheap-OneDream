@extends('layouts.client_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item">My Account</li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('account.partials.aside')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="container mb-2">
                                <ul class="nav nav-pills" id="orderStatusTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Tất cả</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="awaiting-confirmation-tab" data-toggle="tab" href="#awaiting-confirmation" role="tab" aria-controls="awaiting-confirmation" aria-selected="false">Chờ xác nhận</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="processing-tab" data-toggle="tab" href="#processing" role="tab" aria-controls="processing" aria-selected="false">Đang xử lý</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">Đang giao</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Hoàn thành</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Đã hủy</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="orderStatusTabContent">
                                <!-- All Tab -->
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $allOrders])
                                </div>

                                <!-- Awaiting Confirmation Tab -->
                                <div class="tab-pane fade" id="awaiting-confirmation" role="tabpanel" aria-labelledby="awaiting-confirmation-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $pendingOrders])
                                </div>

                                <!-- Processing Tab -->
                                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $processingOrders])
                                </div>

                                <!-- Shipping Tab -->
                                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $shippingOrders])
                                </div>

                                <!-- Completed Tab -->
                                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $completedOrders])
                                </div>

                                <!-- Canceled Tab -->
                                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $canceledOrders])
                                </div>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@foreach ($orders as $order)
@if ($order->order_details->isNotEmpty()) <!-- Ensure order_details is not empty -->
@foreach ($order->order_details as $orderDetail)
@if ($orderDetail->detail_status == 'completed')
@if ($orderDetail->is_reviewed != 'reviewed')
<!-- Modal for submitting review -->
<div class="modal fade" id="review-modal-{{ $orderDetail->detail_order_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="text-center mb-4">Review Product</h5>
                <form action="{{ route('submit.review') }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-start mb-4">
                        <!-- Product Image -->
                        <img src="{{ asset($orderDetail->product_image) }}" alt="{{ $orderDetail->name_product }}" class="rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        <!-- Product Info -->
                        <div class="ml-3" style="flex: 1;">
                            <h6 class="mb-1" style="font-size: 1.2rem;">{{ $orderDetail->name_product }}</h6>
                            <p class="mb-0">Quantity: <strong>{{ $orderDetail->stock }}</strong></p>
                            <p class="mb-0">Category: <strong>{{ $orderDetail->value ?? 'M' }}</strong></p>
                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating_{{ $orderDetail->product_id }}" value="{{ $i }}" id="star{{ $i }}_{{ $orderDetail->product_id }}">
                                <label for="star{{ $i }}_{{ $orderDetail->product_id }}"></label>
                                @endfor
                            </div>
                            @if ($errors->has("rating_{$orderDetail->product_id}"))
                            <div class="text-danger">{{ $errors->first("rating_{$orderDetail->product_id}") }}</div>
                            @endif
                            <div class="form-group">
                                <label for="review-content-{{ $orderDetail->product_id }}">Review Content</label>
                                <textarea id="review-content-{{ $orderDetail->product_id }}" name="review_content_{{ $orderDetail->product_id }}" class="form-control shadow-sm" rows="2" placeholder="Write your review here..."></textarea>
                                @if ($errors->has("review_content_{$orderDetail->product_id}"))
                                <div class="text-danger">{{ $errors->first("review_content_{$orderDetail->product_id}") }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-4">
                        <input type="hidden" name="detail_order_id" value="{{ $orderDetail->detail_order_id }}">
                        <input type="hidden" name="product_id" value="{{ $orderDetail->product_id }}">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Review <i class="fas fa-paper-plane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@elseif ($orderDetail->is_reviewed != 'not_reviewed')
<!-- Modal for viewing review -->
<div class="modal fade" id="view-review-modal-{{ $orderDetail->detail_order_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="text-center mb-4">View Product Review</h5>
                <!-- Display review content -->
                <div class="d-flex align-items-start mb-3">
                    <!-- Product Image -->
                    <img src="{{ asset($orderDetail->product_image) }}" alt="{{ $orderDetail->name_product }}" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                    <!-- Product Info and Review -->
                    <div class="ml-3" style="flex: 1;">
                        <h6>{{ $orderDetail->name_product }}</h6>
                        <div class="ratings-container">
                            <div class="ratings">
                                <!-- Calculate the width based on the rating -->
                                <div class="ratings-val" style="width: {{ $orderDetail->rating * 20 }}%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                        </div><!-- End .ratings-container -->
                        <p class="mt-2">{{ $orderDetail->review_content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endforeach
@endif
@endforeach




<style>
    .rating {
        display: inline-block;
    }

    .rating input {
        display: none;
    }

    .rating label {
        float: right;
        cursor: pointer;
        color: #ccc;
        transition: color 0.3s;
    }

    .rating label:before {
        content: '\2605';
        font-size: 30px;
    }

    .rating input:checked~label,
    .rating label:hover,
    .rating label:hover~label {
        color: #ffc107;
        transition: color 0.3s;
    }

    .shop-name img {
        margin-right: 10px;
    }

    .order-status {
        color: #28a745;
        font-weight: bold;
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .item-details {
        flex-wrap: wrap;
    }

    .item-details div {
        flex: 1 1 auto;
    }

    .item-details img {
        margin-bottom: 10px;
    }

    .btn-rating {
        background-color: #ff5722;
        color: #fff;
    }

    @media (max-width: 430px) {
        .d-flex {
            flex-direction: column;
        }

        .d-flex>div,
        .d-flex>img {
            margin-bottom: 10px;
        }

        .item-details img {
            margin-right: 0;
        }

        .ml-auto {
            margin-left: 0;
        }
    }
</style>

@endsection

@section('script-link-css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session('alert'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "{{ session('alert')['type'] }}",
        title: "{{ session('alert')['message'] }}"
    });
</script> @endif
<script>
    function confirmCancel(event, orderID) {
        event.preventDefault();
        Swal.fire({
            title: "Bạn có chắc chắn muốn hủy đơn hàng?",
            text: "Hủy đơn hàng sẽ không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, hủy đơn hàng!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`cancel-form-${orderID}`).submit();
            }
        });
    }
</script>
<script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
@endsection