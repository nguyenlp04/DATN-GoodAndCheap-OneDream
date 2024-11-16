@extends('layouts.admin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

            <div class="d-flex flex-column justify-content-center">
                <div class="mb-1">
                    <span class="h5">Order #OR-{{ $order->order_id }} </span>
                    @php
                    // Kiểm tra xem tất cả các trạng thái có giống nhau không
                    $allStatusesSame = $orderDetails->pluck('detail_status')->unique()->count() === 1;
                    $status = $allStatusesSame ? $orderDetails->first()->detail_status : null;
                    @endphp

                    @if ($allStatusesSame)
                    <span>
                        @if ($status == 'completed')
                        <span class="badge bg-label-success me-1 ms-2">{{ ucfirst($status) }} - Đơn hàng đã hoàn thành</span>
                        @elseif ($status == 'pending')
                        <span class="badge bg-label-warning me-1 ms-2">{{ ucfirst($status) }} - Chờ xác nhận</span>
                        @elseif ($status == 'canceled')
                        <span class="badge bg-label-danger me-1 ms-2">{{ ucfirst($status) }} - Đơn hàng đã bị hủy</span>
                        @elseif ($status == 'in_progress')
                        <span class="badge bg-label-info me-1 ms-2">{{ ucfirst($status) }} - Chuẩn bị giao cho bên vận chuyển</span>
                        @elseif ($status == 'shipped')
                        <span class="badge bg-label-primary me-1 ms-2">{{ ucfirst($status) }} - Đang giao hàng</span>
                        @else
                        <span class="badge bg-label-secondary me-1 ms-2">{{ ucfirst($status) }} - Trạng thái không xác định</span>
                        @endif
                    </span>
                    @else
                    @foreach ($orderDetails as $detail)
                    @if ($detail->detail_status == 'completed' && $detail->is_reviewed == 'not_reviewed')
                    <span class="badge bg-label-success me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    <span class="badge bg-label-secondary me-1 ms-2">Đơn hàng đã hoàn thành chờ đánh giá</span>
                    @elseif ($detail->detail_status == 'completed' && $detail->is_reviewed == 'reviewed')
                    <span class="badge bg-label-success me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    <span class="badge bg-label-warning me-1 ms-2">Đơn hàng đã hoàn thành đã đánh giá</span>
                    @elseif ($detail->detail_status == 'pending')
                    <span class="badge bg-label-warning me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    <span class="badge bg-label-warning me-1 ms-2">Chờ xác nhận</span>
                    @elseif ($detail->detail_status == 'canceled')
                    <span class="badge bg-label-danger me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    <span class="badge bg-label-danger me-1 ms-2">Đơn hàng đã bị hủy</span>
                    @elseif ($detail->detail_status == 'in_progress')
                    <span class="badge bg-label-primary me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    <span class="badge bg-label-primary me-1 ms-2">Chuẩn bị giao cho bên vận chuyển</span>
                    @else
                    <span class="badge bg-label-info me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    @endif
                    @endforeach
                    @endif
                    <!-- <span class="badge bg-label-info">Ready to Pickup</span> -->
                </div>
                <p class="mb-0">Aug 17, <span id="orderYear">2024</span>, 5:48 (ET)</p>
            </div>

        </div>

        <!-- Order Details Table -->

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Order details</h5>
                        <h6 class="m-0"><a href="">Edit</a></h6>
                    </div>
                    <div>
                        <div>
                            <table class="datatables-order-details table border-top dataTable no-footer dtr-column" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th>products</th>
                                        <th>price</th>
                                        <th>qty</th>
                                        <!-- <th>total</th> -->
                                        <th>status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderDetails as $detail)
                                    <tr>
                                        <td class="sorting_1">
                                            <div class="d-flex justify-content-start align-items-center text-nowrap">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ asset($detail->product_image) }}" alt="product">
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-heading mb-0" style="white-space: normal; word-wrap: break-word; word-break: break-word;">
                                                        {{ $detail->name_product }}
                                                    </h6>
                                                    <small style="white-space: normal; word-wrap: break-word; word-break: break-word;">{{ $detail->value }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span>${{ number_format($detail->product_price, 2) }}</span></td>
                                        <td><span>{{ $detail->stock }}</span></td>
                                        <!-- <td><span>${{ number_format($detail->product_price * $detail->stock, 2) }}</span></td> -->
                                        <td>
                                            @if ($detail->detail_status == 'completed')
                                            <span id="order-status-{{ $detail->detail_order_id }}" class="badge bg-label-success me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                                            @elseif ($detail->detail_status == 'pending')
                                            <span id="order-status-{{ $detail->detail_order_id }}" class="badge bg-label-warning me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                                            @elseif ($detail->detail_status == 'canceled')
                                            <span id="order-status-{{ $detail->detail_order_id }}" class="badge bg-label-danger me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                                            @elseif ($detail->detail_status == 'in_progress')
                                            <span id="order-status-{{ $detail->detail_order_id }}" class="badge bg-label-primary me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                                            @else
                                            <span id="order-status-{{ $detail->detail_order_id }}" class="badge bg-label-info me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="" id="dropdown-{{ $detail->detail_order_id }}">
                                                @if($detail->detail_status == 'pending')
                                                <a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('{{ $detail->detail_order_id }}', 'in_progress')">
                                                    <span><i class="fa-solid fa-pen-to-square me-1"></i></span> Xác nhận
                                                </a>
                                                @elseif($detail->detail_status == 'in_progress')
                                                <a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('{{ $detail->detail_order_id }}', 'shipped')">
                                                    <span><i class="fa-solid fa-truck me-1"></i></span> Đã giao bên vận chuyển
                                                </a>
                                                @elseif($detail->detail_status == 'shipped')
                                                <a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('{{ $detail->detail_order_id }}', 'completed')">
                                                    <span><i class="fa-solid fa-check-circle me-1"></i></span> Hoàn thành
                                                </a>
                                                @elseif($detail->detail_status == 'canceled')
                                                <a class="text-white rounded badge bg-danger" href="javascript:void(0);">
                                                    <span><i class="fa-solid fa-check-circle me-1"></i></span> Đã hủy
                                                </a>
                                                @elseif($detail->detail_status == 'completed' && $detail->is_reviewed == 'not_reviewed')
                                                <a class="text-white rounded badge bg-secondary" href="javascript:void(0);">
                                                    <span><i class="fa-solid fa-star me-1"></i></span> Chờ đánh giá
                                                </a>
                                                @elseif($detail->detail_status == 'completed' && $detail->is_reviewed == 'reviewed')
                                                <a class="text-white rounded badge bg-warning" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#reviewModal-{{ $detail->detail_order_id }}">
                                                    <span><i class="fa-solid fa-star me-1"></i></span> Xem đánh giá
                                                </a>

                                                @else
                                                <a class="text-white rounded badge bg-primary" href="javascript:void(0);">
                                                    <span><i class="fa-solid fa-question-circle me-1"></i></span> Chưa xác định
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end align-items-center m-4 mb-2">
                            <div class="order-calculations">
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="w-px-100 text-heading">Subtotal:</span>
                                    <h6 class="mb-0">$2093</h6>
                                </div>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="w-px-100 text-heading">Discount:</span>
                                    <h6 class="mb-0">$2</h6>
                                </div>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="w-px-100 text-heading">Tax:</span>
                                    <h6 class="mb-0">$28</h6>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <h6 class="w-px-100 mb-0">Total:</h6>
                                    <h6 class="mb-0">$2113</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">Customer details</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-6">
                            <div class="avatar me-3">
                                <img src="{{ asset($order->image_user) }}" alt="Avatar" class="rounded-circle">

                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html" class="text-body text-nowrap">
                                    <h6 class="mb-0">{{ $order->full_name }}</h6>
                                </a>
                                <span>Customer ID: #{{ $order->order_id }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-6">
                            <span class="avatar rounded-circle bg-label-success me-3 d-flex align-items-center justify-content-center">
                                <i class="bx bx-cart bx-lg"></i>
                            </span>
                            <h6 class="text-nowrap mb-0">{{ $totalOrders }} Orders</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">Contact info</h6>
                        </div>
                        <p class="mb-1">Email: {{ $order->email }}</p>
                        <p class="mb-0">Mobile: {{ $order->phone_number }}</p>
                    </div>
                </div>
                <div class="card mb-6">

                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0">Shipping address</h5>
                        <!-- <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a></h6> -->
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $order->address }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@foreach($orderDetails as $detail)
<!-- / Content wrapper -->
@if($detail->detail_status == 'completed' && $detail->is_reviewed == 'reviewed')
<div class="modal fade dtr-bs-modal" id="reviewModal-{{ $detail->detail_order_id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel-{{ $detail->detail_order_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="reviewModalLabel-{{ $detail->detail_order_id }}">Review Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr data-dt-row="8" data-dt-column="2">
                            <td>Product:</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center customer-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="{{ asset($detail->product_image ?? 'https://via.placeholder.com/80') }}" alt="Product Image" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium text-heading">{{ $detail->name_product }}</span>
                                        <small>{{ $detail->description }}</small>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr data-dt-row="8" data-dt-column="3">
                            <td>Reviewer:</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center customer-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-4">
                                            <img src="{{ asset($detail->reviewer_avatar ?? 'https://via.placeholder.com/50') }}" alt="Reviewer Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ $detail->reviewer_name }}</span>
                                        <small class="text-nowrap">{{ $detail->reviewer_email }}</small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr data-dt-row="8" data-dt-column="4">
                            <td>Review:</td>
                            <td>
                                <div>
                                    <div class="read-only-ratings ps-0 mb-1 jq-ry-container" readonly="readonly" style="width: 132px;">
                                        <div class="jq-ry-group-wrapper">
                                            <div class="jq-ry-normal-group jq-ry-group">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: {{ $i <= $detail->review_rating ? '#FFD43B' : '#E0E0E0' }};"></i>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p class="h6 mb-1 text-truncate">{{ $detail->review_content }}</p> -->
                                    <small class="text-break pe-3">{{ $detail->review_content }}</small>
                                </div>
                            </td>
                        </tr>
                        <tr data-dt-row="8" data-dt-column="5">
                            <td>Date:</td>
                            <td><span class="text-nowrap">{{ $detail->review_created_at }}</span></td>
                        </tr>
                        <tr data-dt-row="8" data-dt-column="6">
                            <td>Status:</td>
                            <td>
                                <span class="badge bg-label-{{ $detail->review_status == 1 ? 'warning' : 'success' }}" text-capitalize="">
                                    {{ $detail->review_status == 1 ? 'Not answered' : 'Answered' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Reply:</td>
                            <td>
                                @if($detail->review_status == 1)
                                <!-- Form to write a reply -->
                                <form action="{{ route('reviews.reply') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ $detail->review_id }}">
                                    <textarea name="content" class="form-control mb-2" rows="3" placeholder="Write your reply here..."></textarea>
                                    <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                                </form>
                                @else
                                <!-- Display already answered reply -->
                                <p class="mt-2">{{ $detail->reply_content ?? 'No reply yet.' }}</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach


@endsection
@section('script-link-css')
<script>
    function updateOrderStatus(detail_order_id, status) {
        $.ajax({
            url: "{{ url('/order-affiliate') }}/" + detail_order_id + "/update-status",
            type: "PUT",
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    const statusElement = document.getElementById('order-status-' + detail_order_id);
                    if (statusElement) {
                        statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);

                        // Remove existing classes and add new class based on status
                        statusElement.classList.remove('bg-label-success', 'bg-label-warning', 'bg-label-danger', 'bg-label-primary', 'bg-label-info');
                        if (status === 'completed') {
                            statusElement.classList.add('bg-label-success');
                        } else if (status === 'pending') {
                            statusElement.classList.add('bg-label-warning');
                        } else if (status === 'canceled') {
                            statusElement.classList.add('bg-label-danger');
                        } else if (status === 'in_progress') {
                            statusElement.classList.add('bg-label-primary');
                        } else {
                            statusElement.classList.add('bg-label-info');
                        }
                    }

                    const dropdownElement = document.getElementById('dropdown-' + detail_order_id);
                    if (dropdownElement) {
                        let dropdownHtml = '';
                        if (status === 'pending') {
                            dropdownHtml = `<a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('${detail_order_id}', 'in_progress')">
                            <span><i class="fa-solid fa-pen-to-square me-1"></i></span> Xác nhận
                        </a>`;
                        } else if (status === 'in_progress') {
                            dropdownHtml = `<a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('${detail_order_id}', 'shipped')">
                            <span><i class="fa-solid fa-truck me-1"></i></span> Đã giao bên vận chuyển
                        </a>`;
                        } else if (status === 'shipped') {
                            dropdownHtml = `<a class="text-white rounded badge bg-primary" href="javascript:void(0);" onclick="updateOrderStatus('${detail_order_id}', 'completed')">
                            <span><i class="fa-solid fa-check-circle me-1"></i></span> Đơn hàng đã hoàn thành
                        </a>`;
                        } else if (status === 'completed') {
                            dropdownHtml = `<a class="text-white rounded badge bg-primary" href="javascript:void(0);">
                            <span><i class="fa-solid fa-star me-1"></i></span> Chờ đánh giá
                        </a>`;
                        } else {
                            dropdownHtml = `<a class="text-white rounded badge bg-primary" href="javascript:void(0);">
                            <span><i class="fa-solid fa-question-circle me-1"></i></span> Trạng thái chưa xác định
                        </a>`;
                        }
                        dropdownElement.innerHTML = dropdownHtml;
                    }
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: 'Không thể cập nhật trạng thái đơn hàng.'
                });
            }
        });
    }
</script>
@endsection