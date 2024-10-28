@extends('layouts.admin')
@section('content')
<!-- Layout container -->
<div class="layout-page">
  <!-- Navbar -->
  <nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="{{ url("javascript:void(0)") }}">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
          <i class="bx bx-search fs-4 lh-0"></i>
          <input
            type="text"
            class="form-control border-0 shadow-none"
            placeholder="Search..."
            aria-label="Search..." />
        </div>
      </div>
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="{{ url("javascript:void(0);") }}" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ url("#") }}">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                      <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">John Doe</span>
                    <small class="text-muted">Admin</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url("profile.html") }}">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">My Profile</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url("#") }}">
                <i class="bx bx-cog me-2"></i>
                <span class="align-middle">Settings</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url("#") }}">
                <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                  <span class="flex-grow-1 align-middle">Billing</span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                </span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url("auth-login-basic.html") }}">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- / Navbar -->

  <!-- Content wrapper -->
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
                            <form action="{{ route('notifications.restore', $notification->id_notifications) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning me-2" title="Restore">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </form>
                            <form action="{{ route('notifications.forceDelete', $notification->id_notifications) }}" method="POST" onsubmit="return confirmDelete()" class="d-inline">
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
                  new DataTable('#example');
                </script>
               
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
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
      <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
          ©
          <script>
            document.write(new Date().getFullYear());
          </script>
          , made with ❤️ by
          <a href="https://OneDream.com" target="_blank" class="footer-link fw-bolder">OneDream</a>
        </div>
      </div>
    </footer>
    <!-- / Footer -->
  </div>
  <!-- / Content wrapper -->
</div>
@endsection
