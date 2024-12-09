@extends('layouts.partner_layout')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Greeting Message at the Top -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Congratulations {{ auth()->user()->channel->name_channel }}🎉</h5>
                        <p class="mb-4">
                            Have a nice day!
                        </p>
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="{{ asset('/../admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140"
                                alt="View Badge User"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/chart-success.png') }}"
                                    alt="chart success"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Sales count</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $sale_count }}</h3>
                        <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> 
                            {{ $percentageDifference > 0 ? '+' : '' }}{{ number_format($percentageDifference, 2) }}%
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span>Payments today</span>
                        <h3 class="card-title text-nowrap mb-2">${{ number_format($todayRevenue, 2) }}</h3>
                        <small class="text-danger fw-semibold">
                            <i class="bx bx-down-arrow-alt"></i> -14.82%
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="d-block mb-1">Transaction Yesterday</span>
                        <h3 class="card-title mb-2">${{ number_format($yesterdayRevenue, 2) }}</h3>
                        <small class="text-danger fw-semibold">
                            <i class="bx bx-down-arrow-alt"></i> -5.12%
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Users"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="d-block mb-1"> Transactions Count</span>
                        <h3 class="card-title mb-2">{{ $todayTransactionsCount }}</h3>
                        <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> +3.25%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->

<div class="content-backdrop fade"></div>
</div>

<!-- Core JS -->
<script src="{{ asset('/../admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('/../admin/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('/../admin/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('/../admin/assets/vendor/js/menu.js') }}"></script>
@endsection
