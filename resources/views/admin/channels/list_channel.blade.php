@extends('layouts.admin')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


    <div class="app-ecommerce" data-select2-id="21">

      <!-- Add Channel -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Channels</h4>
        </div>

      </div>

      <div class="row" data-select2-id="20">

        <!-- First column-->
        <div class="col-12 col-lg-12">
          <!-- Channel Information -->
          <div class="card mb-6">
            <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Id Channel</th>
                    <th>Channel Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($channels as $channel)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-label-info my-1">ID: {{ $channel->channel_id }}</span>
                      </div>
                      <div>
                        <span class="badge bg-label-info my-1"> {{ date('D, d M Y', strtotime($channel->created_at)) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="flex-grow-1 d-flex align-items-center">
                          <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $channel->name_channel }}</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="flex-grow-1 d-flex align-items-center">
                          {{ $channel->address }}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="flex-grow-1 d-flex align-items-center">
                          {{ $channel->phone_number }}
                        </div>
                      </div>
                    </td>
                    <td class="bg-light rounded">
                      @if ($channel->status == 1)
                      <span class="badge bg-label-success">Active</span>
                      @else
                      <span class="badge bg-label-danger">Inactive</span>
                      @endif
                    </td>
                    <td>

                      <div class="container">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu">
                          <li data-bs-toggle="modal" data-bs-target="#modal{{ $channel->channel_id }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('channels.edit', $channel->channel_id) }}"> <span><i class="fa-solid fa-pen-to-square me-1"></i></span>Edit</a>
                            </li>
                            <li>
                              <a onclick="confirmDelete(event, {{ $channel->channel_id }})">
                                <form id="delete-form-{{ $channel->channel_id }}" action="{{ route('channels.destroy', $channel->channel_id) }}" method="POST" style="display:inline;">
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
                      <div class="modal fade" id="modal{{ $channel->channel_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $channel->channel_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $channel->name_channel }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td class="col-3">Channel Name:</td>
                                    <td class="col-9">{{ $channel->name_channel }}</td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Address:</td>
                                    <td class="col-9">{{ $channel->address }}</td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Phone Number:</td>
                                    <td class="col-9">{{ $channel->phone_number }}</td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Status:</td>
                                    <td class="col-9">
                                      @if ($channel->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Inactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9">{{ date('D, d M Y', strtotime($channel->created_at)) }}</td>
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
