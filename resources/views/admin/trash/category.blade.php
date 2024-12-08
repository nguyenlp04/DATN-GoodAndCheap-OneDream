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
                            <h5 class="card-title mb-0">Trash Category</h5>
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
                                    <th>Id Category</th>
                                    <th>Category</th>
                                    <th>Sub Category Count</th>
                                    <th>Attribute Count</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @foreach($data as $category)
                                 <tr>
                    <td>
                      <div>
                        <span class="badge bg-info my-1">ID: {{ $category->category_id }}</span>
                      </div>
                      <div>
                        <span class="badge bg-info my-1"> {{ date('D, d M Y', strtotime($category->created_at)) }}</span>
                      </div>
                    <td>
                      <div class="d-flex align-items-center">
                        <div style="min-width: 80px; max-width: 80px;">
                          <img src="{{ asset( $category->image_category) }}" alt="Image Category" class="rounded img-fluid" style="width: 100%; height: auto; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $category->name_category }}</p>
                        </div>
                      </div>
                    </td>
                    <td>{{ $category->sub_category_count }}</td>
                    <td>{{ $category->attribute_count }}</td>
                    <td class="bg-light rounded">
                      @if ($category->status == 1)
                      <span class="badge bg-success">Active</span>
                      @else
                      <span class="badge bg-danger">Deactive</span>
                      @endif
                    </td>
                    <td>

                     <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li data-bs-toggle="modal" data-bs-target="#modal{{ $category->category_id }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                        <li>
                            <form action="{{ route('restore-category', $category->category_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item ">
                                    <span><i class="fa-solid fa-rotate-right"></i></span> restore
                                </button>
                            </form>
                        </li>
                        <li>
                            <a onclick="confirmDelete(event, {{ $category->category_id }})">
                                <form id="delete-form-{{ $category->category_id }}"
                                    action="{{ route('delete-category', $category->category_id) }}" method="POST">
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
                <div class="modal fade" id="modal{{ $category->category_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $category->category_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $category->name_category }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="{{ asset($category->image_category) }}" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $category->name_category }}</h6>
                                          <small class="text-truncate-1">{{ $category->description }}</small>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Sub Category:</td>
                                    <td class="col-9"><span>{{ implode(', ', explode(',', $category->sub_category_names)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Variant:</td>
                                    <td class="col-9"><span>{{ implode(', ', explode(',', $category->attribute_names)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="8">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($category->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $category->staff_full_name }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($category->created_at)) }}</span></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      </td>


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
