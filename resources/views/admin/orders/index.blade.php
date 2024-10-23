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
                    <th>Order ID</th>
                    <th>Payment Method</th>
                    <th>Name Receiver</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- Đổi Xem thành Actions để có nhiều hành động hơn -->
                    <th>status update</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $item)
                  <tr>
                    <td>OR-{{ $item->order_id }}</td>
                    <td>{{ $item->payment_method_name }}</td>
                    <td>{{ $item->name_receiver }}</td>
                    <td>${{ number_format($item->price, 0) }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                      <!-- Nút mở modal để xem chi tiết đơn hàng -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $item->order_id }}">
                        <i class="fa-solid fa-eye"></i>
                      </button>
                    </td>
                    <td>
                      <!-- Nút cập nhật trạng thái -->
                      @if ($item->status == 'pending')
                      <button class="btn btn-warning btn-update-status" data-order-id="{{ $item->order_id }}" data-status="in_progress">In Progress (Đang xử lý)</button>
                      @elseif ($item->status == 'in_progress')
                      <button class="btn btn-primary btn-update-status" data-order-id="{{ $item->order_id }}" data-status="shipped">Shipped (Đang giao hàng)</button>
                      @elseif ($item->status == 'shipped')
                      <button class="btn btn-info btn-update-status" data-order-id="{{ $item->order_id }}" data-status="completed">Completed (Đã hoàn thành)</button>
                      @elseif ($item->status == 'completed')
                      <span class="badge bg-success">Completed (Đã hoàn thành)</span>
                      @elseif ($item->status == 'canceled')
                      <span class="badge bg-danger">Canceled (Đã hủy)</span>
                      @else
                      <span class="badge bg-secondary">{{ $item->status }}</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Order ID</th>
                    <th>Payment Method</th>
                    <th>Name Receiver</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>status update</th>
                  </tr>
                </tfoot>
              </table>
              @foreach ($orders as $item)
              <!-- Modal hiển thị chi tiết đơn hàng -->
              <div class="modal fade" id="modal{{ $item->order_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->order_id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel{{ $item->order_id }}">Order #{{ $item->order_id }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Tên khách hàng:</strong> {{ $item->full_name }}</p>
                      <p><strong>Tên người nhận:</strong> {{ $item->name_receiver }}</p>
                      <p><strong>Địa chỉ:</strong> {{ $item->address }}</p>
                      <p><strong>Số điện thoại:</strong> {{ $item->phone_number }}</p>
                      <p><strong>Phương thức thanh toán:</strong> {{ $item->payment_method_name }}</p>
                      <p><strong>Trạng thái:</strong> {{ $item->status }}</p>
                      <!-- Hiển thị chi tiết sản phẩm trong đơn hàng -->
                      <!-- Hiển thị chi tiết sản phẩm trong đơn hàng, nhóm theo kênh -->
                      <p><strong>Chi tiết sản phẩm:</strong></p>

                      @php
                      // Nhóm sản phẩm theo channel_id
                      $groupedDetails = $item->order_details->groupBy('channel_id');
                      @endphp

                      @foreach ($groupedDetails as $channelId => $details)
                      <!-- Hiển thị thông tin kênh chỉ một lần -->
                      <div class="channel-info">
                        <img src="{{ asset($details->first()->image_channel) }}" alt="Channel Logo">
                        <p>Kênh: {{ $details->first()->name_channel }}</p>
                      </div>

                      @foreach ($details as $detail)
                      <div class="small"> <!-- Thêm class "small" để điều chỉnh kích thước font -->
                        <div class="row align-items-center mb-2">
                          <div class="col-md-2">
                            <img src="{{ asset($detail->first_image) }}" class="img-fluid" alt="Sản phẩm">
                          </div>
                          <div class="col-md-7">
                            <h6 class="mb-0">{{ $detail->name_product }}</h6>
                            <p class="mb-0">Phân loại hàng: m</p>
                            <p class="mb-0">x{{ $detail->stock }}</p>
                          </div>
                          <div class="col-md-3 text-right">
                            <h6 class="text-danger mb-0">₫{{ number_format($detail->price, 0) }}</h6>
                          </div>
                        </div>
                      </div>
                      <hr>
                      @endforeach
                      @endforeach

                      <br>
                      <p><strong>Tổng cộng:</strong> ${{ number_format($item->price, 0) }}</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
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
<!-- Bootstrap CSS -->
<style>
  .channel-info {
    display: flex;
    align-items: center;
  }

  .channel-info img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
    border-radius: 50%;
  }

  .channel-info p {
    margin: 0;
  }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  new DataTable('#example');
</script>
<script>
  $(document).ready(function() {
    $('.btn-update-status').click(function() {
      var orderId = $(this).data('order-id');
      var status = $(this).data('status');

      $.ajax({
        url: '/admin/orders/update-status/' + orderId,
        type: 'POST',
        data: {
          status: status,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            location.reload(); // Hoặc cập nhật trạng thái trong HTML mà không cần load lại trang
            Toast.fire({
              icon: 'success',
              title: response.message
            });
          } else {
            Toast.fire({
              icon: 'error',
              title: response.message
            });
          }
        },
        error: function() {
          Toast.fire({
            icon: 'error',
            title: 'Đã xảy ra lỗi, vui lòng thử lại.'
          });
        }
      });
    });
  });
</script>
@if (session('alert'))
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  Toast.fire({
    icon: "{{ session('alert')['type'] }}",
    title: "{{ session('alert')['message'] }}"
  });
</script>
@endif
@endsection