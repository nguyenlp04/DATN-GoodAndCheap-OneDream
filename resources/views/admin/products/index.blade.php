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
        <div class="col-12 col-lg-12">
          <!-- Product Information -->
          <div class="card mb-6">
            <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>ID Product</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $sale_news)
                  {{-- {{dd($data)}} --}}
                  {{-- {{dd($sale_news->firstImage)}} --}}
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-info my-1">ID: {{ $sale_news->sale_new_id }}</span>
                      </div>
                      <div>
                        <span class="badge bg-info my-1">${{ number_format($sale_news->price, 2) }}</span>
                      </div>
                      <div>
                        <span class="badge bg-info my-1"> {{ date('D, d M Y', strtotime($sale_news->created_at)) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div style="min-width: 80px; max-width: 80px;">
                          {{-- {{dd($sale_news)}} --}}
                          {{-- <img src="{{ asset( $sale_news->firstImage->image_name) }}" alt="Image Product" class="rounded img-fluid" style="width: 100%; object-fit: cover;"> --}}
                        </div>
                        <div class="flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $sale_news->title }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="bg-light rounded">
                      <span class="badge bg-primary">{{ $sale_news->categoryToSubcategory->name_category }}</span>
                      <span class="text-muted"> &#8212; </span>
                      <span class="badge bg-secondary">{{ $sale_news->subcategory->name_sub_category }}</span>
                    </td>
                    <td class="bg-light rounded">
                      @if ($sale_news->status == 1)
                      <span class="badge bg-label-success">Active</span>
                      @else
                      <span class="badge bg-label-danger">Deactive</span>
                      @endif
                    </td>
                    <td>
                      <div class="container">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li data-bs-toggle="modal" data-bs-target="#modal{{ $sale_news->sale_new_id }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                            <li>
                              {{-- <a class="dropdown-item" href="{{ route('product/update') }}"> <span><i class="fa-solid fa-pen-to-square me-1"></i></span>Edit</a> --}}
                            </li>
                            <li>
                              {{-- <a onclick="confirmDelete(event, {{ $sale_news->sale_new_id }})">
                                <form id="delete-form-{{ $sale_news->sale_new_id }}" action="{{ route('deleteProduct', $sale_news->sale_new_id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="dropdown-item">
                                    <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                  </button>
                                </form>
                              </a> --}}
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="modal fade" id="modal{{ $sale_news->sale_new_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $sale_news->sale_new_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $sale_news->title }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Product:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            {{-- <img src="{{ asset($sale_news->firstImage->image_name) }}" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;"> --}}
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $sale_news->title }}</h6>
                                          <small class="text-truncate-1">{{ $sale_news->description }}</small>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-primary">{{ $sale_news->categoryToSubcategory->name_category }}</span>
                                      <span class="text-muted"> &#8594; </span>
                                      <span class="badge bg-secondary">{{ $sale_news->subcategory->name_sub_category }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($sale_news->price, 2) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="8">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($sale_news->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $sale_news->user->full_name }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($sale_news->created_at)) }}</span></td>
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
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /Second column -->
      </div>
    </div>
  </div>
  <!-- / Content -->
  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection