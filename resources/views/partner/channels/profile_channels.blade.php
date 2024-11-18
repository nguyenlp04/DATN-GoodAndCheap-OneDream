@extends('layouts.client_layout')

@section('content')
<style>
    .channel-info {
        display: flex;
        align-items: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 15px;
        background-color: #f9f9f9;
        margin: 20px auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .channel-info:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .channel-info img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        transition: transform 0.3s ease;
    }

    .channel-info img:hover {
        transform: scale(1.1);
    }

    .channel-name {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .channel-username {
        font-size: 16px;
        color: #888;
        margin-bottom: 10px;
    }

    .channel-stats {
        color: #555;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .channel-stats span {
        margin-right: 15px;
    }

    .channel-actions a {
        border-radius: 25px;
        padding: 8px 20px;
        font-size: 14px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .channel-actions a:hover {
        background-color: #0056b3;
    }

    .channel-actions .btn-danger:hover {
        background-color: #d9534f;
    }

    .stats-info {
        font-size: 14px;
        color: #e84e40;
        display: flex;
        align-items: center;
    }

    .stats-info i {
        margin-right: 5px;
    }

    .heading .title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .heading-right .title-link {
        font-size: 16px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .heading-right .title-link:hover {
        text-decoration: underline;
    }

    .sale-card {
        border: 1px solid #ddd;
        border-radius: 15px;
        background-color: #f9f9f9;
        margin: 15px 0;
        padding: 15px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .sale-card .title {
        font-size: 18px;
        font-weight: bold;
    }

    .sale-card .price {
        color: #e84e40;
        font-size: 16px;
        font-weight: bold;
    }

    .sale-card .description {
        color: #555;
        font-size: 14px;
    }

    .sale-card .status {
        font-size: 14px;
        color: #888;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

<main class="container pt-5 mb-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="channel-info">
                <!-- Channel Image -->
                <img src="{{ asset('storage/' . ($channels->image_channel ?? 'assets/images/image.png')) }}" alt="{{ $channels->name_channel }}" class="rounded-circle me-3">
                <!-- Channel Details -->
                <div class="flex-grow-1">
                    <div class="channel-name">{{ $channels->name_channel }}</div>
                    <div class="channel-username">{{ $channels->username }}</div>
                    <div class="channel-stats">
                        <span>{{ $channels->followers_count }} 2.3K Followers</span> |
                        <span><i class="bi bi-star-fill text-warning"></i> {{ $channels->rating }} 123 Reviews</span>
                    </div>
                    <div class="channel-actions d-flex gap-3 mt-3">
                        <a href="#" class="btn btn-danger btn-sm">Create New Sale</a>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="d-flex align-items-end">
                    <div class="stats-info">
                        <i class="bi bi-box-seam"></i> {{ $NewsCount }} New Sales |
                    </div>
                </div>
            </div>
        </div>

        <div class="container for-you">
            <div class="heading heading-flex mb-4">
                <div class="heading-left">
                    <h2 class="title">My Sales News</h2>
                </div>
                <div class="heading-right">
                    <a href="#" class="title-link">View All Recommendations <i class="icon-long-arrow-right"></i></a>
                </div>
            </div>

            <!-- Sales News -->
            @foreach ($sale_news as $sale_new)
            <div class="sale-card">
                <div class="title">{{ $sale_new->title }}</div>
                <div class="title">
                    @php
                        // Giải mã chuỗi JSON để có thể truy xuất các giá trị
                        $data = json_decode($sale_new->data, true);
                    @endphp
                
                    @if ($data && isset($data[0]['name']))
                        {{ $data[0]['name'] }}
                    @else
                        Không có tên
                    @endif
                </div>
                <div class="price">{{ $sale_new->price }} VND</div>
                <div class="description">{{ Str::limit($sale_new->description, 100) }}</div>
                <div class="description" style="float: right">{{ $sale_new ->created_at }}</div>
                {{-- <div class="status">
                    Status: 
                    @if ($sale_new->status == 1)
                        <span class="text-success">Active</span>
                    @else
                        <span class="text-danger">Inactive</span>
                    @endif
                </div> --}}
                <div class="channel-actions d-flex gap-3 mt-2">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
