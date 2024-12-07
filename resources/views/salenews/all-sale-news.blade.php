@extends('layouts.client_layout')

<style>
    /* Đảm bảo các ảnh luôn chiếm đầy không gian mà không bị méo */
    .product-media img {
        object-fit: cover;
        width: 100%;
        height: 200px; /* Chỉnh chiều cao cố định cho ảnh */
        border-radius: 10px;
    }

</style>

@section('content')
<div class="container">
    <!-- Tiêu đề -->
    <h2 class="title text-center mb-4 mt-2">What's Hot Today?</h2>

    <!-- Tabs danh mục -->
    <div class="cat-blocks-container">
        <div class="row">
            <!-- Tab "Tất cả tin đăng" -->
            <div class="col-6 col-sm-4 col-lg-2">
                <a href="javascript:void(0);" onclick="openTab(event, 'catall')" class="cat-block tablinks active">
                        <span>
                            <img src="{{ asset('storage/category/hot.png') }}" alt="All categories" class="img-fluid" width="100px">
                        </span>
                    <h3 class="cat-block-title">Hot news</h3>
                </a>
            </div>

            <!-- Các danh mục khác -->
            @foreach($groupedData as $categoryId => $items)
                @if ($categoryId !== 'all')
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="javascript:void(0);" onclick="openTab(event, 'cat{{ $categoryId }}')" class="cat-block tablinks">
                        <figure>
                            <span>
                                <img src="{{ asset($items->first()->sub_category->category->image_category ?? 'default-placeholder.jpg') }}" alt="Category image" >
                            </span>
                        </figure>
                        <h3 class="cat-block-title ">{{ $items->first()->sub_category->category->name_category }}</h3>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="mb-4">
        @foreach($groupedData as $categoryId => $items)
            <div id="cat{{ $categoryId }}" class="tabcontent" style="display: {{ $categoryId === 'all' ? 'block' : 'none' }};">
                <div class="row">
                    @foreach ($items as $item)
                    <div class="col-12 col-sm-6 col-lg-3 mb-4">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}" class="image-container">
                                    @if ($item->images->isNotEmpty())
                                        <img src="{{ $item->images->first()->image_name }}" alt="{{ $item->title }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('default-placeholder.jpg') }}" alt="No Image" class="img-fluid">
                                    @endif
                                </a>
                                <div class="product-action-vertical">
                                    <form action="{{ route('addToWishlist') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="sale_new_id" value="{{ $item->sale_new_id }}">
                                        <button type="submit" class="btn-product-icon btn-wishlist color-danger add-to-wishlist-btn"
                                            title="Add to Wishlist"></button>
                                    </form>
                                </div>
                            </figure>
                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('salenew.detail' ,$item->sale_new_id) }}">
                                        {{ Str::limit($item->title, 35, '...') }}
                                    </a>
                                </h3>
                                <div class="product-price">${{ number_format($item->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    var firstTab = document.querySelector('.tablinks.active');
    if (firstTab) {
        firstTab.click();
    }
});

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
}
</script>
@endsection
