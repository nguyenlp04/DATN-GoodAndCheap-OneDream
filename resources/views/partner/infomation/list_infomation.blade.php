@extends('layouts.partner_layout')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


    <div class="app-ecommerce" data-select2-id="21">

      <!-- Add Product -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">infomation</h4>
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
                    <th>Id infomation</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($infomations as $infomation)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-label-info my-1">ID: {{ $infomation->infomation_id }}</span>
                      </div>
                      <div>
                        <span class="badge bg-label-info my-1"> {{ date('D, d M Y', strtotime($infomation->created_at)) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $infomation->title_infomation }}</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="flex-grow-1 d-flex align-items-center">
                          @if(!empty($infomation->user_names) && count($infomation->user_names) > 0)
                                {{ implode(', ', $infomation->user_names) }}
                            @elseif(!empty($infomation->channel_names) && count($infomation->channel_names) > 0)
                                 {{ implode(', ', $infomation->channel_names) }}
                            @else
                                {{ 'Global Website' }}     
                            @endif
                        </div>
                      </div>
                      
                    </td>
                    <td class="bg-light rounded">
                      @if ($infomation->status == 'public')
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
                          <li data-bs-toggle="modal" data-bs-target="#modal{{ $infomation->infomation_id }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('infomations.edit', $infomation->infomation_id) }}"> <span><i class="fa-solid fa-pen-to-square me-1"></i></span>Edit</a>
                            </li>
                            <li>
                              <a onclick="confirmDelete(event, {{ $infomation->infomation_id }})">
                                <form id="delete-form-{{ $infomation->infomation_id }}" action="{{ route('infomations.destroy', $infomation->infomation_id) }}" method="POST" style="display:inline;">
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
                      <div class="modal fade" id="modal{{ $infomation->infomation_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $infomation->infomation_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $infomation->name_infomation }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">infomation:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <h5 class="mb-0 text-truncate-1">{{ $infomation->title_infomation }}</h5>
                                        
                                        </div>
                                       
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Content infomation:</td>
                                    <td class="col-9"><span>{!! Str::limit($infomation->content_infomation, 10) !!}</span></td>
                                  </tr>
                                  <br>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">To:</td>
                                    <td class="col-9"><span>
                                      @if(!empty($infomation->user_names) && count($infomation->user_names) > 0)
                                {{ implode(', ', $infomation->user_names) }}
                            @elseif(!empty($infomation->channel_names) && count($infomation->channel_names) > 0)
                                 {{ implode(', ', $infomation->channel_names) }}
                            @else
                                {{ 'Global Website' }}     
                            @endif
                          </span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="8">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($infomation->status == 'public')
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($infomation->created_at)) }}</span></td>
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