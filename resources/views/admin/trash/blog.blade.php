@extends('layouts.admin')
@section('content')



          <div class="content-wrapper">


            <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


                <div class="app-ecommerce" data-select2-id="21">

                  <!-- tieeu de -->
                  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                      <h4 class="mb-1">Trash management</h4>
                    </div>

                  </div>



                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Trash Blog</h5>
                        </div>
                        <div class="row" data-select2-id="20">
                            <!-- First column-->
                            <div class="col-12 col-lg-12">
                                <!-- Product Information -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th class="px-1">Start date</th>
                                        <th class="px-1">Update date</th>
                                        <th>content</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ Str::limit($blog->title, 50, '...') }}</td>
                                        <td><img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                                style="width: 70px; height: auto;"></td>
                                        <td class="px-1">{{ $blog->created_at->format('Y-m-d') }}</td>
                                        <td class="px-1">{{ $blog->updated_at->format('Y-m-d') }}</td>

                                        <td>
                                              <button type="button" class="p-0 m-0 border-0 bg-transparent"
                                                data-bs-toggle="modal" data-bs-target="#modal{{ $blog->blog_id }}">
                                                <span class="text-primary"><i class="fa-solid fa-eye"></i></span>
                                            </button>
                                        </td>
                                        <td>


                                            <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <ul class="dropdown-menu">

                        <li>
                            <form action="{{ route('restore-blog', $blog->blog_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item ">
                                    <span><i class="fa-solid fa-rotate-right"></i></span> restore
                                </button>
                            </form>
                        </li>
                        <li>
                            <a onclick="confirmDelete(event, {{ $blog->blog_id }})">
                                <form id="delete-form-{{ $blog->blog_id }}"
                                    action="{{ route('delete-blog', $blog->blog_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">
                                        <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                    </button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>



                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $blog->blog_id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel{{ $blog->blog_id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel{{ $blog->blog_id }}">Info Blog</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="mx-2 blog-info">
                                                                <div class="info-item">
                                                                    <strong>Image:</strong>
                                                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                                                        alt="Blog Image" class="blog-image">
                                                                </div>

                                                                <div class="info-item">
                                                                    <strong>ID:</strong>
                                                                    {{ $blog->blog_id }}
                                                                </div>

                                                                <div class="info-item">
                                                                    <strong>Tags:</strong>
                                                                    {{ $blog->tags}}
                                                                </div>
                                                                <div class="info-item">
                                                                    <strong>Title:</strong>
                                                                    {{ $blog->title }}
                                                                </div>


                                                                <div class="info-item">
                                                                    <strong>Description:</strong>
                                                                    {{ $blog->short_description }}
                                                                </div>

                                                                <div class="info-item">
                                                                    <strong>Content:</strong>
                                                                    <div class="content-scroll">
                                                                        {!! $blog->content !!}
                                                                    </div>
                                                                </div>

                                                                <div class="info-item">
                                                                    <strong>Start date:</strong>
                                                                    {{ $blog->created_at->format('Y-m-d') }}
                                                                </div>

                                                                <div class="info-item">
                                                                    <strong>Status:</strong>
                                                                    <span
                                                                        class="modal-status {{ $blog->status == 1 ? 'text-primary' : 'text-secondary' }}">
                                                                        {{ $blog->status == 1 ? 'Active' : 'Inactive' }}
                                                                    </span>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->




          </div>


        @endsection
        @section('script-link-css')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>
{{-- <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css"> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
{{-- no ko buton dc  --}}




    <script>

        function confirmCheckLock(event,userID) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "If you agree, this account will be locked !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I agree!"
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById(`check-lock-form-${userID}`).submit();
                }
            });
        }
    </script>

@endsection
