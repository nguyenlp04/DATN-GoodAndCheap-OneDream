@extends('layouts.admin')
@section('content')
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">
      <div class="app-ecommerce" data-select2-id="21">
        <!-- Add notifications -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
          <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1">Notifications</h4>
          </div>
        </div>
       
        <div class="row" data-select2-id="20">
          <!-- First column-->
          <div class="col-12 col-lg-12">
            <!-- Notifications Information -->
            <div class="card mb-6">
              <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Image</th>
                      <th class="px-1">Start date</th>
                      <th class="px-1">Update date</th>
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
                          <td class="d-flex align-items-center">
                            <form action="{{ route('notifications.restore', $notification->notification_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning me-2" title="Restore">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </form>
                            <form action="{{ route('notifications.forceDelete', $notification->notification_id) }}" method="POST" onsubmit="return confirmDelete()" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Delete Permanently">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Title</th>
                      <th>Image</th>
                      <th class="px-1">Start date</th>
                      <th class="px-1">Update date</th>
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
                      
                      $.ajax({
                          url: `/notifications/toggleStatus/${notificationId}`,
                          type: 'PATCH',
                          data: {
                              _token: '{{ csrf_token() }}'
                          },
                          success: function(response) {
                              Swal.fire(response.message, '', response.status === "public" ? 'success' : 'warning');
                              location.reload(); // Refresh để cập nhật lại trạng thái
                          },
                          error: function() {
                              Swal.fire('Error', 'Unable to toggle status', 'error');
                          }
                      });
                  }
                  function confirmDelete() {
        return confirm('Are you sure you want to delete this notification?');
    }
                </script>
              </div>
            </div>
          </div>
          <!-- /Second column -->
        </div>
      </div>
    <!-- / Content -->
  </div>
  <!-- / Content wrapper -->
</div>
@endsection
