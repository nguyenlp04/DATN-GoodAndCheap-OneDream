@extends('layouts.partner_layout')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
        <div class="row">
            <!-- Sale Count -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                  <a href="{{ url('partners/sale-news') }}">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/border-all-solid.svg') }}"
                                    alt="chart success"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Sales Count</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $saleCount }}</h3>
                    </div>
                  </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
              <div class="card d-flex align-items-stretch">
                  <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                              <img
                                  src="{{ asset('/../admin/assets/img/icons/unicons/image.png') }}"
                                  alt="chart success"
                                  class="rounded"
                              />
                          </div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Total Views</span>
                      <h3 class="card-title text-nowrap mb-1">{{ $totalViews }}</h3>
                  </div>
              </div>
          </div>
            <div class="col-xl-12 col-md-12 order-3 order-lg-4 mb-8 mb-lg-0">
              <div class="card text-center">
                  <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Most Viewed Sale Sews</h5>
                      
                  </div>
                  <div class="tab-content pt-0 pb-4">
                      <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                          <div class="table-responsive text-start text-nowrap">
                              <table class="table table-borderless">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Title</th>
                                          <th>View</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      @foreach ($top3Sales as $item)
                                          <tr>
                                              <td>{{ $item->sale_new_id }}</td>
                                              <td>{{ $item->title ?? '123' }}</td>
                                              <td>{{ $item->views }}</td>
                                              <td>
                              <a class="dropdown-item" href="{{ route('salenew.detail' ,$item->sale_new_id) }}"><span><i class="fa-solid fa-eye me-1"></i></span></a>
                                                 
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

            <!-- Transactions Count Today -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/user-plus-solid.svg') }}"
                                    alt="Users"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="d-block mb-1">Fllower</span>
                        <h3 class="card-title mb-2">{{ $followCount }}</h3>
                    </div>
                </div>
            </div>

           

            <!-- This Month Revenue -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="card d-flex align-items-stretch">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{ asset('/../admin/assets/img/icons/unicons/square-check-solid.svg') }}"
                                    alt="chart success"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Sold news</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $soldnewCount }}</h3>
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
@endsection
