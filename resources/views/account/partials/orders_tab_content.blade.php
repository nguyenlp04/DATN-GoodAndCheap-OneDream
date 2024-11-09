@foreach ($orders as $order)
<div class="order-container p-3 border rounded">
    <div class="d-flex justify-content-between align-items-center order-status mb-3">
        @switch($order->status)
        @case('canceled')
        <span class="badge badge-danger d-block mb-1">Order Canceled</span>
        <span class="badge badge-light d-block">Status Canceled</span>
        @break
        @case('completed')
        <span class="badge badge-success d-block mb-1">Delivered Successfully</span>
        <span class="badge badge-primary d-block">COMPLETED</span>
        @break
        @case('in_progress')
        <span class="badge badge-warning d-block mb-1">In Transit</span>
        <span class="badge badge-secondary d-block">On the way</span>
        @break
        @case('pending')
        <span class="badge badge-secondary d-block mb-1">Pending</span>
        <span class="badge badge-light d-block">Waiting for confirmation</span>
        @break
        @case('shipped')
        <span class="badge badge-info d-block mb-1">Shipped</span>
        <span class="badge badge-warning d-block">Processing</span>
        @break
        @default
        <span class="badge badge-light d-block mb-1">Unknown Status</span>
        <span class="badge badge-danger d-block">Contact support</span>
        @endswitch
    </div>
    @php
    $groupedDetails = $order->order_details->groupBy('channel_id');
    @endphp
    @foreach ($groupedDetails as $channelId => $details)
    <div class="d-flex justify-content-between align-items-center">
        <div class="shop-name d-flex align-items-center font-weight-bold">
            <span><i class="fas fa-store"></i> {{ $details->first()->name_channel ?? 'Trusted Seller' }}</span>
        </div>
        <div>
            <a href="#" class="btn btn-outline-primary-2">Chat</a>
            <a href="#" class="btn btn-outline-primary-2">View Shop</a>
        </div>
    </div>

    @foreach ($details as $detail)
    <div class="item-details d-flex align-items-start mt-0 pb-1 border-bottom">
        <img src="{{ asset($detail->first_image) }}" alt="Product" class="item-image mr-3" style="width: 80px; height: 80px;">
        <div>
            <h6 class="mb-1 title">{{ $detail->name_product }}</h6>
            <p>Category: {{ $detail->value }}</p>
            <p>Quantity: x{{ $detail->stock }}</p>
        </div>
        <div class="ml-auto">
            <p>₫{{ number_format($detail->price, 0, ',', '.') }}</p>
        </div>
    </div>
    @endforeach
    @endforeach
    <div class="d-flex justify-content-end mt-2">
        <h5>Total: <span class="text-danger">₫{{ number_format($order->price, 0, ',', '.') }}</span></h5>
    </div>
    <div class="d-flex justify-content-start mt-2">
        @if ($order->status == 'completed')
        @if ($order->is_reviewed == 'reviewed')
        <!-- Button to View Review -->
        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#view-review-modal-{{ $order->order_id }}">
            Xem lại đánh giá
        </button>
        @else
        <!-- Button to Add Review -->
        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#review-modal-{{ $order->order_id }}">
            Đánh giá sản phẩm
        </button>
        @endif
        @endif
        @if(in_array($order->status, ['in_progress', 'pending']))
        <button class="btn btn-danger mr-2" onclick="confirmCancel(event, '{{ $order->order_id }}')">
            Hủy Đơn Hàng
        </button>
        <form id="cancel-form-{{ $order->order_id }}" action="{{ route('order.cancel', $order->order_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
        </form>
        @endif

        <!-- <button class="btn btn-outline-secondary">Buy Again</button> -->
    </div>
</div>
@endforeach

<!-- Review Modal -->