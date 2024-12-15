@extends('layouts.client_layout')

@section('content')
    <style>
        .product-media img {
            object-fit: cover;
            width: 100%;
            height: 200px;
        }

        .product-body {
            height: 130px;
        }

        .tablinks img {
            height: 70px;
        }
    </style>

    <div class="container">
        <!-- Tabs danh mục -->
        <div class="cat-blocks-container mt-2">
            <div class="row">
                <!-- Tab "Tất cả tin đăng" -->
                <div class="col-4 col-sm-3 col-lg-2">
                    <a href="{{ route('salenews.all', ['category' => 'all']) }}"
                        class="cat-block tablinks {{ $currentCategoryId === 'all' ? 'active' : '' }}" data-category-id="all">
                        <span>
                            <img src="{{ asset('storage/settings/logo_mobile_1733765090.png') }}" alt="All categories"
                                class="img-fluid">
                        </span>
                        <h3 class="cat-block-title">Hot news</h3>
                    </a>
                </div>

                <!-- Các danh mục khác -->
                @foreach ($categories as $category)
                    <div class="col-4 col-sm-3 col-lg-2">
                        <a href="{{ route('salenews.all', ['category' => $category->category_id]) }}"
                            class="cat-block tablinks {{ $currentCategoryId == $category->category_id ? 'active' : '' }}"
                            data-category-id="{{ $category->category_id }}">
                            <span>
                                <img src="{{ asset($category->image_category ?? 'default-placeholder.jpg') }}"
                                    alt="{{ $category->name_category }}" class="img-fluid">
                            </span>
                            <h3 class="cat-block-title">{{ $category->name_category }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="row mt-4" id="product-list">
            @if ($items->isEmpty())
                <div class="col-12">
                    <p>No product in this category.</p>
                </div>
            @else
                @foreach ($items as $item)
                    <div class="col-12 col-sm-6 col-lg-3 mb-4">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('salenew.detail', $item->sale_new_id) }}">
                                    <img src="{{ $item->images->first()->image_name ?? asset('default-placeholder.jpg') }}"
                                        alt="{{ $item->title }}" class="img-fluid">
                                </a>
                            </figure>
                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('salenew.detail', $item->sale_new_id) }}">
                                        {{ Str::limit($item->title, 35, '...') }}
                                    </a>
                                </h3>
                                <div class="product-price">
                                    ${{ number_format($item->price, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Phân trang -->
        <div class="pagination-wrapper" id="pagination">
            {{ $items->links() }}
        </div>
    </div>

    <script>
        $(document).on('click', '.cat-block.tablinks', function(e) {
            e.preventDefault();

            const categoryId = $(this).data('category-id'); // Lấy ID danh mục
            const url = "{{ route('salenews.all') }}"; // URL gốc

            // Gửi yêu cầu AJAX
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    category: categoryId
                },
                beforeSend: function() {
                    $('#product-list').html('<p>Đang tải dữ liệu...</p>'); // Loading
                },
                success: function(response) {
                    // Cập nhật danh sách sản phẩm
                    $('#product-list').html(response.html);

                    // Cập nhật phân trang
                    $('#pagination').html(response.pagination);
                },
                error: function() {
                    alert('Không thể tải dữ liệu.');
                }
            });
        });

        // AJAX cho phân trang
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function() {
                    $('#product-list').html('<p>Đang tải dữ liệu...</p>'); // Loading
                },
                success: function(response) {
                    // Cập nhật danh sách sản phẩm
                    $('#product-list').html(response.html);

                    // Cập nhật phân trang
                    $('#pagination').html(response.pagination);
                },
                error: function() {
                    alert('Không thể tải dữ liệu.');
                }
            });
        });
    </script>

@endsection
