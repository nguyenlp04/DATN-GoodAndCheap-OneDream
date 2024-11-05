@extends('layouts.admin')
@section('content')
<!-- Layout container -->


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
   
@endsection