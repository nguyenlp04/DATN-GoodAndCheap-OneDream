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
                                <div class="">
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <p>Hello <span class="font-weight-normal text-dark">User</span> (not <span
                                            class="font-weight-normal text-dark">User</span>? <a href="#">Log
                                            out</a>)
                                        <br>
                                        From your account dashboard you can view your <a href="#tab-orders"
                                            class="tab-trigger-link link-underline">recent orders</a>, manage your
                                        <a href="#tab-address" class="tab-trigger-link">shipping and billing
                                            addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit
                                            your password and account details</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection