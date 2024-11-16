@extends('layouts.admin')
@section('content')


<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="app-ecommerce">

      <!-- Add Blogs Header -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Blogs</h4>
        </div>
        
      </div>
      
      <!-- Blog Table -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-6">
            <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
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
                    <td>{{ Str::limit($blog->title, 50, '...') }}</td>
                    <td><img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 70px; height: auto;"></td>
                    <td class="px-1">{{ $blog->created_at->format('Y-m-d') }}</td>
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
                      <button type="button" class="p-0 m-0 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#modal{{ $blog->blog_id }}">
                        <span class="text-primary">Detail</span>
                      </button>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $blog->blog_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $blog->blog_id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel{{ $blog->blog_id }}">Info Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3 mx-2">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 100px;">
                              </div>
                              <div class="col-md-7 mx-2">
                                <p><strong>ID:</strong> {{ $blog->blog_id }}</p>
                                <p><strong>Title:</strong> {{ $blog->title }}</p>
                                <p><strong>Description:</strong> {{ $blog->short_description }}</p>
                                    <p><strong>Content:</strong> <span class="modal-content-text">
                                  {!! $blog->content !!}
                                </span></p>
                                <p><strong>Start date:</strong> {{ $blog->created_at->format('Y-m-d') }}</p>
                                <p><strong>Status:</strong> <span class="modal-status {{ $blog->status == 1 ? 'text-primary' : 'text-secondary' }}">
                                      {{ $blog->status == 1 ? 'Show' : 'Hidden' }}
                                  </span></p>
                              
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              
              <!-- JavaScript -->
               
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

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
