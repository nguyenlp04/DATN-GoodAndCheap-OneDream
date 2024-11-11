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
                    @else
                    @foreach ($orderDetails as $detail)
                    @if ($detail->detail_status == 'completed')
                    <span class="badge bg-label-success me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    @elseif ($detail->detail_status == 'pending')
                    <span class="badge bg-label-warning me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    @elseif ($detail->detail_status == 'canceled')
                    <span class="badge bg-label-danger me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    @else
                    <span class="badge bg-label-info me-1 ms-2">{{ ucfirst($detail->detail_status) }}</span>
                    @endif

                    @if ($detail->detail_status == 'canceled')
                    <span class="badge bg-label-danger me-1 ms-2">Đơn hàng đã bị hủy</span>
                    @elseif ($detail->detail_status == 'pending')
                    <span class="badge bg-label-warning me-1 ms-2">Chờ xác nhận</span>
                    @elseif ($detail->detail_status == 'in_progress')
                    <span class="badge bg-label-info me-1 ms-2">Chuẩn bị giao cho bên vận chuyển</span>
                    @elseif ($detail->detail_status == 'shipped')
                    <span class="badge bg-label-primary me-1 ms-2">Đang giao hàng</span>
                    @elseif ($detail->detail_status == 'completed')
                    <span class="badge bg-label-success me-1 ms-2">Đơn hàng đã hoàn thành</span>
                    @else
                    <span class="badge bg-label-secondary me-1 ms-2">Trạng thái không xác định</span>
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
                                        <th>total</th>
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
                                        <td><span>${{ number_format($detail->product_price * $detail->stock, 2) }}</span></td>
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
<!-- / Content wrapper -->

@endsection