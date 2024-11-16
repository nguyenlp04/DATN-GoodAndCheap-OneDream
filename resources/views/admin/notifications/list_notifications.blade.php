@extends('layouts.admin')
@section('content')
<!-- Layout container -->
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">
      <div class="app-ecommerce" data-select2-id="21">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
          <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1">notifications</h4>
          </div>

        </div>
        <div class="row" data-select2-id="20">

          <!-- First column-->
          <div class="col-12 col-lg-12">
            <!-- notifications Information -->
            <div class="card mb-6">
              <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Title</th>
                    <th>Image</th>
                    <th class="px-1">Start date</th>
                    <th class="px-1">Update date</th>
                    <th>Status</th>
                    <th>Actions</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach($notifications as $notification)
            <tr>
                <td>{{ Str::limit($notification->title, 50) }}</td>
                <td><img src="{{ asset('storage/' . $notification->image) }}" alt="Notification Image" style="width: 70px;"></td>
                <td>{{ $notification->created_at->format('Y-m-d') }}</td>
                <td>{{ $notification->updated_at->format('Y-m-d') }}</td>
                <td>
                  <button type="button" id="bt-tb{{ $notification->notification_id }}" class="btn btn-sm {{ $notification->status == 'public' ? 'btn-primary' : 'btn-secondary' }}" data-id="{{ $notification->notification_id }}" onclick="toggleStatus(this)">
                      <i id="bt-i{{ $notification->notification_id }}" class="fas {{ $notification->status == 'public' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                      <span id="bt-sp{{ $notification->notification_id }}">{{ $notification->status == 'public' ? 'Public' : 'Private' }}</span>
                  </button>
              </td>
                <td class="d-flex align-items-center">
                  <a href="{{ route('notifications.edit', $notification->notification_id) }}" class="btn btn-warning me-2">
                      <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('notifications.destroy', $notification->notification_id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                      </button>
                  </form>
              </td>
              
            </tr>
            @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Title</th>
                    <th>Image</th> <!-- Khớp với thead -->
                    <th class="px-1">Start date</th>
                    <th class="px-1">Update date</th>
                    <th>Status</th>
                    <th>Actions</th>
                    
                  </tr>
                </tfoot>
              </table>

                 <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if(session('success'))
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    @endif

                    @if(session('error'))
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    @endif
                });
            </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
               
              <script>
                function toggleStatus(button) {
                    const notificationId = $(button).data('id');
                    // console.log(notificationId);
                    
                    $.ajax({
                        url: `/notifications/toggleStatus/${notificationId}`,
                        type: 'PATCH',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Swal.fire(response.message, '', response.status === "public" ? 'success' : 'warning');
                            
        
                                // Tạo selector cho id động
                                var selector = '#bt-tb' + notificationId;
                                var selector1 = '#bt-i' + notificationId;
                                var selector2 = '#bt-sp' + notificationId;
                            $(selector2).html('')
                            $(selector).removeClass('btn-primary');
                            $(selector).removeClass('btn-secondary');
                            $(selector1).removeClass('fa-eye');
                            $(selector1).removeClass('fa-eye-slash');

                            if(response.status === "public"){
                            $(selector1).addClass('fa-eye');
                            $(selector2).html(response.status)
                            $(selector).addClass('btn-primary');

                            }else{
                            $(selector2).html(response.status)

                            $(selector1).addClass('fa-eye-slash');
                            $(selector).addClass('btn-secondary');
                            }



                            

                            

                            // location.reload();
                        },
                        error: function() {
                            Swal.fire('Error', 'Unable to toggle status', 'error');
                        }
                    });
                }
            </script>
              </div>
            </div>
          <!-- /Second column -->
        </div>
      </div>
    </div>
    <div class="content-backdrop fade"></div>
  </div>
</div>
@endsection
