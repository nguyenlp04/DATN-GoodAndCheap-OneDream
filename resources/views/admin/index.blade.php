@extends('layouts.admin')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card h-100">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    {{-- {{dd($infoStaff)}} --}}
                                    <h5 class="card-title text-primary">Congratulations {{ $data['infoStaff']->full_name }}!
                                        🎉</h5>
                                    <p class="mb-4">
                                        You have done <span class="fw-bold">{{ $data['percentageDifference'] }}%</span> more
                                        sales today. Check your new
                                        badge in
                                        your profile.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('/../admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                        height="140" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Vip Pakcage Sale News</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $data['totalSaleNewsVip'] }}</h3>
                                    <small class="text-danger fw-semibold">
                                        {{-- <i class="bx bx-down-arrow-alt"></i>
                                    -14.82% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Vip Pakcage Channels</span>
                                    <h3 class="card-title mb-2">{{ $data['totalChannelVip'] }}</h3>
                                    <small class="text-success fw-semibold">
                                        {{-- <i class="bx bx-up-arrow-alt"></i>
                                    +28.14% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Transactions Today</span>
                                    <h3 class="card-title mb-2">{{ $data['todayTransactionsCount'] }}</h3>
                                    <small class="text-success fw-semibold">
                                        {{-- <i class="bx bx-up-arrow-alt"></i> --}}
                                        {{-- {{ $data['todayTransactionsCount'] }}% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/paypal.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Revenue Today</span>
                                    <h3 class="card-title mb-2">${{ $data['todayRevenue'] }}</h3>
                                    <small class="text-success fw-semibold">
                                        {{-- <i class="bx bx-up-arrow-alt"></i>
                                    +28.42% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">This Month Revenue</span>
                                    <h3 class="card-title mb-2">${{ $data['thisMonthRevenue'] }}</h3>
                                    <small class="text-success fw-semibold">
                                        {{-- <i class="bx bx-up-arrow-alt"></i>
                                    +28.14% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Sale News</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $data['totalSaleNews'] }}</h3>
                                    <small class="text-danger fw-semibold">
                                        {{-- <i class="bx bx-down-arrow-alt"></i>
                                    -14.82% --}}
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Channel</span>
                                    <h3 class="card-title mb-2">{{ $data['totalChannels'] }}</h3>
                                    <small class="text-success fw-semibold">
                                        {{-- <i class="bx bx-up-arrow-alt"></i>
                                    +28.14% --}}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">View
                                                    More</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('javascript:void(0);') }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Sale News Pending</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $data['totalSaleNewsPending'] }}</h3>
                                    <small class="text-danger fw-semibold">
                                        {{-- <i class="bx bx-down-arrow-alt"></i>
                                    -14.82% --}}
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                {{-- <div class="col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Profile Report</h5>
                                        <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i>
                                            68.2%</small>
                                        <h3 class="mb-0">$84,686k</h3>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Total Revenue -->
                {{-- <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            2022
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                            <a class="dropdown-item" href="{{ url("javascript:void(0);") }}">2021</a>
                                            <a class="dropdown-item" href="{{ url("javascript:void(0);") }}">2020</a>
                                            <a class="dropdown-item" href="{{ url("javascript:void(0);") }}">2019</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="growthChart"></div>
                            <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bx-dollar text-primary"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2022</small>
                                        <h6 class="mb-0">$32.5k</h6>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-info p-2"><i
                                                class="bx bx-wallet text-info"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2021</small>
                                        <h6 class="mb-0">$41.2k</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div> --}}
                <!--/ Total Revenue -->

            </div>
            <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-12 col-lg-12 col-xl-4 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Order Statistics</h5>
                                <small class="text-muted">${{ $data['totalSales'] }} Total Sales</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Select All</a>
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Refresh</a>
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ $data['totalOrders'] }}</h2>
                                    <span>Total Orders</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bx-mobile-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-top justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Package Vip Sale News</h6>
                                            <small class="text-muted">{{ $data['totalOrdersPackageSaleNews'] }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">${{ $data['revenuePackageSaleNews'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class="bx bx-closet"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-top justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Package Vip Channel</h6>
                                            <small class="text-muted">{{ $data['totalOrdersPackageChannel'] }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">${{ $data['revenuePackageChannel'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                {{-- <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class="bx bx-home-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Decor</h6>
                                        <small class="text-muted">Fine Art, Dining</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">849k</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                            class="bx bx-football"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Sports</h6>
                                        <small class="text-muted">Football, Cricket Kit</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">99</small>
                                    </div>
                                </div>
                            </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Order Statistics -->

                <!-- Expense Overview -->
                {{-- <div class="col-md-6 col-lg-4 order-1 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-tabs-line-card-income"
                                        aria-controls="navs-tabs-line-card-income" aria-selected="true">
                                        Income
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab">Expenses</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab">Profit</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body px-0">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                    <div class="d-flex p-4 pt-3">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="{{ asset('/../admin/assets/img/icons/unicons/wallet.png') }}"
                                                alt="User" />
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Total Balance</small>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0 me-1">$459.10</h6>
                                                <small class="text-success fw-semibold">
                                                    <i class="bx bx-chevron-up"></i>
                                                    42.9%
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="incomeChart"></div>
                                    <div class="d-flex justify-content-center pt-4 gap-2">
                                        <div class="flex-shrink-0">
                                            <div id="expensesOfWeek"></div>
                                        </div>
                                        <div>
                                            <p class="mb-n1 mt-1">Expenses This Week</p>
                                            <small class="text-muted">$39 less than last week</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Expense Overview -->


                <!-- Transactions -->
                <div class="col-xl-8 col-md-12 order-3 order-lg-4 mb-8 mb-lg-0">
                    <div class="card text-center">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Transactions</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Last 28 Days</a>
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Last Month</a>
                                    <a class="dropdown-item" href="{{ url('javascript:void(0);') }}">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content pt-0 pb-4">
                            <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                                <div class="table-responsive text-start text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Upgrade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($data['fiveTransactions'] as $item)
                                                <tr>
                                                    <td>{{ $item->transaction_id }}</td>
                                                    <td>{{ $item->user->full_name }}</td>
                                                    <td>${{ number_format($item->amount, 2) }}</td>
                                                    <td>{{ $item->upgrade }}</td>
                                                    <td>
                                                        @if ($item->status == 'Success')
                                                            <span class="badge bg-label-success">Success</span>
                                                        @else
                                                            <span class="badge bg-label-danger">Incomplete</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    

    <script src="{{ asset('/../admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/../admin/assets/vendor/libs/popper/popper.js') }}"></script>


    <script src="{{ asset('/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/../admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/../admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/../admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/../admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;


            const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
                orderChartConfig = {
                    chart: {
                        height: 165,
                        width: 130,
                        type: 'donut'
                    },
                    labels: ['Sale News', 'Channel'],
                    series: [<?php echo $data['percentageSaleNews'] ?>, <?php echo $data['percentageChannels'] ?>],
                    colors: [config.colors.info, config.colors.success],
                    stroke: {
                        width: 5,
                        colors: cardColor
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function(val, opt) {
                            return parseInt(val) + '%';
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            right: 15
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%',
                                labels: {
                                    show: true,
                                    value: {
                                        fontSize: '1.5rem',
                                        fontFamily: 'Public Sans',
                                        color: headingColor,
                                        offsetY: -15,
                                        formatter: function(val) {
                                            return parseInt(val) + '%';
                                        }
                                    },
                                    name: {
                                        offsetY: 20,
                                        fontFamily: 'Public Sans'
                                    },
                                    total: {
                                        show: true,
                                        fontSize: '0.8125rem',
                                        color: axisColor,
                                        label: 'Total',
                                        formatter: function(w) {
                                            return '100%';
                                        }
                                    }
                                }
                            }
                        }
                    }
                };
            if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
                const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                statisticsChart.render();
            }
        })();
    </script>

@endsection
