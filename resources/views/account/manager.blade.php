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
                            <div class="tab-content">
                                <div>
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Bài đã đăng</th>
                                                <th>Ngày đăng</th>
                                                <th>Trạng thái</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bài viết 1</td>
                                                <td>2024-09-25</td>
                                                <td><span class="">Đang chờ duyệt</span>
                                                <td><a href="" style="text-decoration:dashed;">Xem bài
                                                        viết</a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!-- .End .tab-pane -->

                            </div><!-- End .col-lg-9 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection