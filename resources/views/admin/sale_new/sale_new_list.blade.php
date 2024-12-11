@extends('layouts.admin')
@section('content')
<style>
/* Đảm bảo bảng có chiều rộng cố định */
.table td,
.table th {

    white-space: normal;
    /* Đảm bảo không có từ nào bị ẩn */
}

/* Đảm bảo bảng không thay đổi kích thước */
.table {

    width: 100%;
}

/* Điều chỉnh cho các nút trong bảng */
.table .btn {
    width: 40px;
    /* Chiều rộng cố định */
    height: 40px;
    /* Chiều cao cố định */
    padding: 0;
    /* Xóa bỏ padding mặc định */
    margin: 0 5px;
    /* Khoảng cách giữa các nút */
    text-align: center;
    /* Canh giữa nội dung trong nút */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Chỉnh sửa các nút có biểu tượng */
.table .btn i {
    font-size: 20px;
    /* Kích thước icon */
}

/* Đảm bảo khoảng cách đồng đều cho các nút */
.table td .btn {
    margin-right: 10px;
}
</style>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">

            <!-- Add Blogs Header -->
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">Sale News</h4>
                </div>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs mb-2 " role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all" id="tab-all">All news</a>
                </li>

                @if ($data->where('approved', 1)->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#approved" id="tab-approved">Approved</a>
                    </li>
                @endif
                @if ($data->where('approved', 2)->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#rejected" id="tab-rejected">Rejected</a>
                    </li>
                @endif
                @if ($count > 0)
                    <li class="nav-item position-relative">
                        <a class="nav-link" data-bs-toggle="tab" href="#waiting" id="tab-waiting">Waiting for approved</a>
                        <div class="position-absolute top-0 start-100 translate-middle text-center bg-danger d-inline-block rounded-circle"
                            style="width: 20px; height: 20px;">
                            <span class="text-white d-flex justify-content-center align-items-center"
                                style="line-height: 20px; font-size:10px;">{{ $count }}</span>
                        </div>
                    </li>
                @endif
            </ul>

            <!-- Blog Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="card-body">

                            <!-- Tab panes -->
                            <div class="tab-content p-0">

                                <!-- All news Tab -->

                                @include('admin.sale_new.tabs.all')


                                <!-- Active Tab -->
                                @include('admin.sale_new.tabs.approved')

                                <!-- Waiting for approved Tab -->
                                @include('admin.sale_new.tabs.waiting')

                                <!-- Rejected Tab -->
                                @include('admin.sale_new.tabs.rejected')


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content-backdrop fade"></div>
</div>

@endsection
 
 