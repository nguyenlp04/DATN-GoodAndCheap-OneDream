@extends('layouts.client_layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-4">Thông báo</h2>
                <ul class="list-group" id="notification-list">
                @if (!empty($notifications))
                    @for ($i = 0; $i < min(10, count($notifications)); $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $notifications[$i]['title_notification'] }}</h5>
                                <p class="mb-0">{{ $notifications[$i]['content_notification'] }}</p>
                                @php
                                $createdAt = new DateTime($notifications[$i]['created_at']);
                                @endphp
                                <span class="cart-product-info">{{ $createdAt->format('d/m/Y H:i') }}</span>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm view-notification  ">Xem</button>
                                <button class="btn btn-danger btn-sm delete-notification">Xóa</button>
                            </div>
                        </li>
                    @endfor
                @else
                    <li class="list-group-item">Không có thông báo nào.</li>
                @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Chi tiết thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="notification-details">
                    <!-- Nội dung thông báo sẽ được tải động -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
