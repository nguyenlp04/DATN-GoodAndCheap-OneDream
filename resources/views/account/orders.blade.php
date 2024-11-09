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
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                            <div class="container">
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <!-- Tab Navigation -->
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
                            <!-- Tab Content -->
                            <div class="tab-content mt-4" id="orderStatusTabContent">
                                <!-- Tất cả Tab -->
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders])
                                </div>

                                <!-- Chờ xác nhận Tab -->
                                <div class="tab-pane fade" id="awaiting-confirmation" role="tabpanel" aria-labelledby="awaiting-confirmation-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders->where('status', 'pending')])
                                </div>

                                <!-- Đang xử lý Tab -->
                                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders->where('status', 'in_progress')])
                                </div>

                                <!-- Đang giao Tab -->
                                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders->where('status', 'shipped')])
                                </div>

                                <!-- Hoàn thành Tab -->
                                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders->where('status', 'completed')])
                                </div>

                                <!-- Đã hủy Tab -->
                                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                                    @include('account.partials.orders_tab_content', ['orders' => $orders->where('status', 'canceled')])
                                </div>
                            </div>
                            <!-- </div> -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@foreach ($orders as $order)
@if ($order->status == 'completed' && $order->is_reviewed != 'reviewed')
<!-- Modal -->
<div class="modal fade" id="review-modal-{{ $order->order_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="text-center mb-4">Đánh giá sản phẩm</h5>

                <form action="{{ route('submit.review') }}" method="POST">
                    @csrf
                    @foreach ($order->order_details as $orderDetail)
                    <div class="d-flex align-items-start mb-4">
                        <!-- Ảnh sản phẩm -->
                        <img src="{{ asset( $orderDetail->first_image) }}" alt="Tên sản phẩm" class="rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        <!-- Thông tin sản phẩm -->
                        <div class="ml-3" style="flex: 1;">
                            <h6 class="mb-1" style="font-size: 1.2rem;">{{ $orderDetail->name_product }}</h6>
                            <p class="mb-0">Số lượng: <strong>{{ $orderDetail->stock }}</strong></p>
                            <p class="mb-0">Category: <strong>{{ $orderDetail->size ?? 'M' }}</strong></p>
                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating_{{ $orderDetail->product_id }}" value="{{ $i }}" id="star{{ $i }}_{{ $orderDetail->product_id }}">
                                <label for="star{{ $i }}_{{ $orderDetail->product_id }}"></label>
                                @endfor
                            </div>
                            @if ($errors->has("rating_{$orderDetail->product_id}")) <div class="text-danger">{{ $errors->first("rating_{$orderDetail->product_id}") }}</div> @endif <!-- Nội dung đánh giá cho sản phẩm -->
                            <div class="form-group">
                                <label for="review-content-{{ $orderDetail->product_id }}">Nội dung đánh giá</label>
                                <textarea id="review-content-{{ $orderDetail->product_id }}" name="review_content_{{ $orderDetail->product_id }}" class="form-control shadow-sm" rows="2" placeholder="Viết nhận xét của bạn ở đây..."></textarea> @if ($errors->has("review_content_{$orderDetail->product_id}")) <div class="text-danger">{{ $errors->first("review_content_{$orderDetail->product_id}") }}</div> @endif
                            </div>
                        </div>
                    </div> @endforeach <!-- Nút gửi đánh giá -->
                    <div class="form-group text-center mt-4"> <input type="hidden" name="order_id" value="{{ $order->order_id }}"> <button type="submit" class="btn btn-primary btn-lg">GỬI ĐÁNH GIÁ <i class="fas fa-paper-plane ml-2"></i></button> </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@if ($order->status == 'completed' && $order->is_reviewed = 'reviewed')
<div class="modal fade" id="view-review-modal-{{ $order->order_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="text-center mb-4">Xem lại đánh giá sản phẩm</h5>

                <!-- Lặp qua các sản phẩm trong đơn hàng để hiển thị đánh giá -->
                @foreach ($order->order_details as $orderDetail)
                <div class="d-flex align-items-start mb-3">
                    <!-- Ảnh sản phẩm -->
                    <img src="{{ asset($orderDetail->first_image) }}" alt="Tên sản phẩm"
                        class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                    <!-- Thông tin sản phẩm và đánh giá -->
                    <div class="ml-3" style="flex: 1;">
                        <h6>{{ $orderDetail->name_product }}</h6>
                        <!-- Hiển thị đánh giá sao -->
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $orderDetail->user_rating ? 'fa fa-star text-warning' : '' }}"></span>
                                @endfor
                        </div>
                        <!-- Nội dung đánh giá -->
                        <p class="mt-2">{{ $orderDetail->user_review_content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
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
<style>
    .delivery-success {
        color: #28a745;
        /* Màu xanh lá cho thành công */
        font-weight: bold;
    }

    .order-complete {
        color: #007bff;
        /* Màu xanh dương cho hoàn thành */
        font-weight: bold;
    }

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

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-primary {
        background-color: #007bff;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .badge-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .badge-light {
        background-color: #f8f9fa;
        color: #212529;
    }
</style>
<script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
@endsection