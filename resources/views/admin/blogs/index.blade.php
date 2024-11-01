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
      <!-- Search -->
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
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->


        <!-- User -->
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
        <!--/ User -->
      </ul>
    </div>
  </nav>

  <!-- / Navbar -->

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


      <div class="app-ecommerce" data-select2-id="21">

        <!-- Add Blogs -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

          <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1">Blogs</h4>
          </div>

        </div>
       
        <div class="row" data-select2-id="20">

          <!-- First column-->
          <div class="col-12 col-lg-12">
            <!-- Blogs Information -->
            <div class="card mb-6">
              <div class="card-body">
                <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
              <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"> -->

            
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
                  @foreach($blogs as $blog)
                    <tr>
                      <!-- <td>{{ $blog->blog_id }}</td> -->
                      <td>{{ Str::limit($blog->title, 50, '...') }}</td>
                      <td>
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 70px; height: auto;">
                      </td>
                      <td class="px-1" >{{ $blog->created_at->format('Y-m-d') }}</td>
                      <td class="px-1">{{ $blog->updated_at->format('Y-m-d') }}</td>
                      <td>
                        <form action="{{ route('blogs.toggleStatus', $blog->blog_id) }}" method="POST" class="toggle-status-form" data-blog-id="{{ $blog->blog_id }}">
                          @csrf
                          <button type="button" class="btn btn-sm {{ $blog->status == 1 ? 'text-primary' : 'text-secondary' }}" style="position: relative;">
                            <i class="fas {{ $blog->status == 1 ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            <span class="tooltip-text eye">{{ $blog->status == 1 ? 'Show' : 'Hide' }}</span>
                          </button>
                        </form>
                      </td>
                      <td>
                        <div class="icon-wrapper">
                          <a class="text-warning" href="{{ route('blogs.edit', $blog->blog_id) }}">
                            <i class="fas fa-edit"></i>
                            <span class="tooltip-text">Edit</span>
                          </a>
                        </div>
                        <form id="deleteForm_{{ $blog->blog_id }}" action="{{ route('blogs.destroy', $blog->blog_id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <div class="icon-wrapper">
                            <button type="button" class="delete-btn border-0 p-0 btn text-danger" data-blog-id="{{ $blog->blog_id }}">
                              <i class="fas fa-trash"></i>
                            </button>
                            <span class="tooltip-text">Delete</span>
                          </div>
                        </form>
                        <a href="{{ route('blogs.show', $blog->blog_id) }}">Detail</a>
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
                  new DataTable('#example');
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

    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
</div>
@endsection