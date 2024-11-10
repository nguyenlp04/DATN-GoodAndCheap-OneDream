@extends('layouts.admin')

@section('content')
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>

<!-- Layout container -->
<!-- / Navbar -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">
        <div class="app-ecommerce" data-select2-id="21">
            <!-- Add Product -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">Order</h4>
                </div>
            </div>
            <div class="row" data-select2-id="20">
                <!-- First column-->
                <div class="col-12 col-lg-12">
                    <!-- Product Information -->
                    <div class="card mb-6">
                        <div class="card-body">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Reviewer</th>
                                        <th>Review</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td class="sorting_1" style="">
                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar me-4 rounded-2 bg-label-secondary"><img src="{{ asset($review->image_name) }}" alt="{{ $review->name_product }}" class="rounded"></div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-medium text-nowrap text-heading">{{ $review->name_product }}</span>
                                                    <small>{{ \Illuminate\Support\Str::limit($review->description, 50, '...') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar avatar-sm me-4"><img src="{{ asset($review->image_user) }}" alt="Avatar" class="rounded-circle"></div>
                                                </div>
                                                <div class="d-flex flex-column"><a href="app-ecommerce-customer-details-overview.html"><span class="fw-medium">{{ $review->full_name }}</span></a><small class="text-nowrap">{{ $review->email }}</small></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="read-only-ratings ps-0 mb-1 jq-ry-container" readonly="readonly" style="width: 132px;">
                                                    <div class="jq-ry-group-wrapper">
                                                        <div class="jq-ry-normal-group jq-ry-group">
                                                            @for($i = 0; $i < $review->Star; $i++)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <p class="h6 mb-1 text-truncate">Ut mauris</p> -->
                                                <small class="text-break pe-3">{{ $review->content  }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-nowrap">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                                                <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product</th>
                                        <th>Reviewer</th>
                                        <th>Review</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Second column -->
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Footer -->
    <!-- / Footer -->
</div>
<!-- / Content wrapper -->
@endsection
@section('script-link-css')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    new DataTable('#example');
</script>
@endsection