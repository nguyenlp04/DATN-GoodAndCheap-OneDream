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
          <h4 class="mb-1">$sale_new</h4>
        </div>

      </div>

      <div class="row" data-select2-id="20">

        <!-- First column-->
        <div class="col-12 col-lg-12">
          <!-- Product Information -->
          <div class="card mb-6">
            <div class="card-body">
               <!-- <pre style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
            {{-- {{ json_encode($data, JSON_PRETTY_PRINT) }} --}}
        </pre> -->
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Id $sale_new</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($$sale_news as $$sale_new)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-label-info my-1">ID: {{ $$sale_new->$sale_new_id }}</span>
                      </div>
                      <div>
                        <span class="badge bg-label-info my-1"> {{ date('D, d M Y', strtotime($$sale_new->created_at)) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $$sale_new->title_$sale_new }}</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                      </div>
                      
                    </td>
                    <td class="bg-light rounded">
                      @if ($$sale_new->status == 'public')
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
                          <li data-bs-toggle="modal" data-bs-target="#modal{{ $$sale_new->$sale_new_id }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('$sale_news.edit', $$sale_new->$sale_new_id) }}"> <span><i class="fa-solid fa-pen-to-square me-1"></i></span>Edit</a>
                            </li>
                            <li>
                              <a onclick="confirmDelete(event, {{ $$sale_new->$sale_new_id }})">
                                <form id="delete-form-{{ $$sale_new->$sale_new_id }}" action="{{ route('$sale_news.destroy', $$sale_new->$sale_new_id) }}" method="POST" style="display:inline;">
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
                      </div>
                      <div class="modal fade" id="modal{{ $$sale_new->$sale_new_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $$sale_new->$sale_new_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $$sale_new->name_$sale_new }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">$sale_new:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <h5 class="mb-0 text-truncate-1">{{ $$sale_new->title_$sale_new }}</h5>
                                        
                                        </div>
                                       
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Content $sale_new:</td>
                                    <td class="col-9"><span>{!! Str::limit($$sale_new->content_$sale_new, 10) !!}</span></td>
                                  </tr>
                                  <br>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">To:</td>
                                    <td class="col-9"><span>
                                      @if(!empty($$sale_new->user_names) && count($$sale_new->user_names) > 0)
                                {{ implode(', ', $$sale_new->user_names) }}
                            @elseif(!empty($$sale_new->channel_names) && count($$sale_new->channel_names) > 0)
                                 {{ implode(', ', $$sale_new->channel_names) }}
                            @else
                                {{ 'Global Website' }}     
                            @endif
                          </span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="8">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($$sale_new->status == 'public')
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($$sale_new->created_at)) }}</span></td>
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