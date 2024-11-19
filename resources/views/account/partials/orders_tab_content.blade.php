@foreach($orders as $order)

@php
$goodAndCheapItems = $order->order_details->where('channel_id', null)->where('staff_id', '!=', null);

$channelItems = $order->order_details->where('channel_id', '!=', null)->where('staff_id', null)->groupBy('channel_id');
@endphp

<!-- Hiển thị sản phẩm của "Good & Cheap" -->
@if($goodAndCheapItems->isNotEmpty())
<div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
    <div class="shop-name d-flex align-items-center font-weight-bold">
        <img src="{{ asset('assets/images/demos/demo-4/logo.png') }}" alt="Shop Icon" class="img-fluid" style="max-width: 80px;">
        <span>Good & Cheap</span>
    </div>
</div>

@foreach($goodAndCheapItems as $item)
<!-- Order Status -->
<div class="d-flex justify-content-between align-items-center">
    @if ($item->detail_status == 'completed')
    <div class="badge p-2 bg-success text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đã hoàn thành</div>
    @elseif ($item->detail_status == 'pending')
    <div class="badge p-2 bg-warning text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Chờ xác nhận</div>
    @elseif ($item->detail_status == 'canceled')
    <div class="badge p-2 bg-danger text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đã bị hủy</div>
    @elseif ($item->detail_status == 'in_progress')
    <div class="badge p-2 bg-info text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Chuẩn bị giao cho bên vận chuyển</div>
    @elseif ($item->detail_status == 'shipped')
    <div class="badge p-2 bg-primary text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đang giao hàng</div>
    @else
    <div class="badge p-2 bg-secondary text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Trạng thái không xác định</div>
    @endif
    @if($item->detail_status === 'completed' && $item->is_reviewed == 'not_reviewed')
    <button type="button" class="btn btn-outline-warning p-2" data-toggle="modal" data-target="#review-modal-{{ $item->detail_order_id }}">
        Đánh giá
    </button>
    @endif
    @if($item->detail_status === 'completed' && $item->is_reviewed == 'reviewed')
    <button type="button" class="btn btn-outline-warning p-2" data-toggle="modal" data-target="#view-review-modal-{{ $item->detail_order_id }}">
        Xem lại đánh giá
    </button>
    @endif

</div>
<div class="item-details d-flex align-items-start mt-2 pb-1 border-bottom position-relative">
    <img src="{{ asset($item->product_image ?? 'https://via.placeholder.com/80') }}" alt="Product" class="item-image mr-3">
    <div class="item-info" style="max-width: 600px;">
        <h5 class="product-name text-truncate">{{ $item->name_product }}</h5>
        <p>Phân loại hàng: {{ $item->value }}</p>
        <p>x{{ $item->stock }}</p>
    </div>
    <div class="price ml-auto position-absolute" style="right: 0;">
        <p>₫{{ number_format($item->total_price, 0, ',', '.') }}</p>
    </div>
</div>
@endforeach
@endif
<!-- Hiển thị các nhóm sản phẩm khác theo channel_id -->
@foreach($channelItems as $channel_id => $items)
<div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
    <div class="shop-name d-flex align-items-center font-weight-bold">
        <i class="fas fa-store"></i>
        <span>{{ $items->first()->name_channel ?? 'Tên kênh' }}</span>
    </div>
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mt-2 mt-md-0">
        <a href="#" class="btn btn-sm btn-secondary">Xem Shop</a>
    </div>
</div>

@foreach($items as $item)
<!-- Order Status -->
<div class="d-flex justify-content-between align-items-center">
    @if ($item->detail_status == 'completed')
    <div class="badge p-2 bg-success text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đã hoàn thành</div>
    @elseif ($item->detail_status == 'pending')
    <div class="badge p-2 bg-warning text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Chờ xác nhận</div>
    @elseif ($item->detail_status == 'canceled')
    <div class="badge p-2 bg-danger text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đã bị hủy</div>
    @elseif ($item->detail_status == 'in_progress')
    <div class="badge p-2 bg-info text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Chuẩn bị giao cho bên vận chuyển</div>
    @elseif ($item->detail_status == 'shipped')
    <div class="badge p-2 bg-primary text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Đang giao hàng</div>
    @else
    <div class="badge p-2 bg-secondary text-white ms-2 me-1">{{ ucfirst($item->detail_status) }} - Trạng thái không xác định</div>
    @endif
    @if($item->detail_status === 'completed' && $item->is_reviewed == 'not_reviewed')
    <button type="button" class="btn btn-outline-warning p-2" data-toggle="modal" data-target="#review-modal-{{ $item->detail_order_id }}">
        Đánh giá
    </button>
    @endif
    @if($item->detail_status === 'completed' && $item->is_reviewed == 'reviewed')
    <button type="button" class="btn btn-outline-warning p-2" data-toggle="modal" data-target="#view-review-modal-{{ $item->detail_order_id }}">
        Xem lại đánh giá
    </button>
    @endif
</div>
<div class="item-details d-flex align-items-start mt-2 pb-1 border-bottom position-relative">
    <img src="{{ asset($item->product_image ?? 'https://via.placeholder.com/80') }}" alt="Product" class="item-image mr-3">
    <div class="item-info" style="max-width: 600px;">
        <h5 class="product-name text-truncate">{{ $item->name_product }}</h5>
        <p>Phân loại hàng: {{ $item->value }}</p>
        <p>x{{ $item->stock }}</p>
    </div>
    <div class="price ml-auto position-absolute" style="right: 0;">
        <p>₫{{ number_format($item->total_price, 0, ',', '.') }}</p>
    </div>
</div>
@endforeach
@endforeach
<!-- Tổng tiền của đơn hàng -->
<div class="d-flex justify-content-end mt-2">
    <h5>Thành tiền: <span class="text-danger">₫{{ number_format($order->price, 0, ',', '.') }}</span></h5>
</div>

<!-- Nút hành động cho đơn hàng -->
<!-- <div class="d-flex justify-content-start mt-2 flex-wrap">
    <button class="btn btn-rating mr-2 mb-2">Đánh Giá</button>
    <button class="btn btn-outline-secondary mr-2 mb-2">Liên Hệ Người Bán</button>
    <button class="btn btn-outline-secondary mb-2">Mua Lại</button>
</div> -->
@endforeach
<!-- <div class="order-container">
    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
        <div class="shop-name d-flex align-items-center font-weight-bold">
            <i class="fas fa-store"></i>
            <span> Tên kênh</span>
        </div>
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mt-2 mt-md-0">
            <a href="#" class="btn btn-sm btn-secondary">Xem Shop</a>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span>Giao hàng thành công</span>
        <span class="order-status">HOÀN THÀNH</span>
    </div>
    <div class="item-details d-flex align-items-start mt-2 pb-1 border-bottom position-relative">
        <img src="https://via.placeholder.com/80" alt="Product" class="item-image mr-3">
        <div class="item-info" style="max-width: 600px;">
            <h5 class="product-name text-truncate">Nước làm mát động cơ xe máy Honda/Yamaha dsada đasad ădsa dsa đsad âdsad adas đa sd ad a</h5>
            <p>Phân loại hàng: Honda</p>
            <p>x1</p>
        </div>
        <div class="price ml-auto position-absolute" style="right: 0;">
            <p>₫13.000</p>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
        <div class="shop-name d-flex align-items-center font-weight-bold">
            <img src="{{ asset('assets/images/demos/demo-4/logo.png') }}" alt="Shop Icon" class="img-fluid" style="max-width: 80px;">
            <span>Good & Cheap</span>
        </div>
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mt-2 mt-md-0">
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span>Giao hàng thành công</span>
        <span class="order-status">HOÀN THÀNH</span>
    </div>
    <div class="item-details d-flex align-items-start mt-2 pb-1 border-bottom position-relative">
        <img src="https://via.placeholder.com/80" alt="Product" class="item-image mr-3">
        <div class="item-info" style="max-width: 600px;">
            <h5 class="product-name text-truncate">Nước làm mát động cơ xe máy Honda/Yamaha dsada đasad ădsa dsa đsad âdsad adas đa sd ad a</h5>
            <p>Phân loại hàng: Honda</p>
            <p>x1</p>
        </div>
        <div class="price ml-auto position-absolute" style="right: 0;">
            <p>₫13.000</p>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <h5>Thành tiền: <span class="text-danger">₫14.960</span></h5>
    </div>
    <div class="d-flex justify-content-start mt-2 flex-wrap">
        <button class="btn btn-rating mr-2 mb-2">Đánh Giá</button>
        <button class="btn btn-outline-secondary mr-2 mb-2">Liên Hệ Người Bán</button>
        <button class="btn btn-outline-secondary mb-2">Mua Lại</button>
    </div>
</div> -->