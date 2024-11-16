@extends('layouts.admin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">

    <div class="app-ecommerce" data-select2-id="21">

      <!-- Add Product -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Product</h4>
        </div>

      </div>

      <div class="row" data-select2-id="20">

        <!-- First column-->
        <div class="col-12">
          <!-- Product Information -->
          <div class="card mb-6">
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Customers</th>
                      <th>Payment</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                      <td>
                        <div>
                          <span class="badge bg-info my-1">ID: OR-{{ $order->order_id }}</span>
                        </div>
                        <div>
                          <span class="badge bg-info my-1">${{ number_format($order->price, 2) }}</span>
                        </div>
                      </td>
                      <td><span class="text-nowrap">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y, H:i') }}</span></td>
                      <td>
                        <div class="d-flex justify-content-start align-items-center order-name text-nowrap">
                          <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3"><img src="{{ asset($order->image_user) }}" alt="Avatar" class="rounded-circle"></div>
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="m-0"><a href="pages-profile-user.html" class="text-heading">{{ $order->full_name }}</a></h6><small>{{ $order->email }}</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <h6 class="mb-0 align-items-center d-flex w-px-100 text-warning"><i class="bx bxs-circle bx-8px me-1"></i>{{ $order->name_method }}</h6>
                      </td>
                      <td>
                        <span id="order-status-{{ $order->order_id }}" class="badge px-2 
        @if($order->detail_status == 'canceled')
            bg-label-danger
        @elseif($order->detail_status == 'completed')
            bg-label-success
        @elseif($order->detail_status == 'in_progress')
            bg-label-warning
        @elseif($order->detail_status == 'pending')
            bg-label-info
        @elseif($order->detail_status == 'shipped')
            bg-label-primary
        @elseif($order->detail_status == 'processing')
            bg-label-secondary
        @endif
      text-capitalized">
                          {{ ucfirst($order->detail_status) }}
                        </span>
                      </td>
                      <td>
                        <div class="container">
                          <div class="btn-group">
                            <a href="{{ route('order-affiliate.details', ['id' => $order->order_id]) }}">
                              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow">
                                <span><i class="fa-solid fa-eye me-1"></i></span>
                              </button>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Customers</th>
                      <th>Payment</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /Second column -->
      </div>
    </div>
  </div>
  <!-- / Content -->
</div>
<!-- / Content wrapper -->


@endsection