@extends('layouts.partner_layout')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="app-ecommerce">

      <!-- Add Product -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Notification</h4>
        </div>
      </div>

      <div class="row">

        <!-- First column-->
        <div class="col-12 col-lg-12">
          <!-- Product Information -->
          <div class="card mb-6">
            <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Id notification</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($notifications as $notification)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-label-info my-1">ID: {{ $notification['notification_id'] }}</span>
                      </div>
                      <div>
                        <span class="badge bg-label-info my-1"> {{ date('D, d M Y', strtotime($notification['created_at'])) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="flex-grow-1 d-flex align-items-center">
                        <p class="mb-0 text-truncate-3 ms-3 w-100">{{ $notification['title_notification'] }}</p>
                      </div>
                    </td>
                    <td>
                        <div class="flex-grow-1 d-flex align-items-center">
                            <p class="mb-0 text-truncate-3 ms-3 w-100">{!! $notification['content_notification'] !!}</p>
                          </div>
                    </td>
                   
                    <td>
                      <div class="container">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li data-bs-toggle="modal" data-bs-target="#modal{{ $notification['notification_id'] }}">
                              <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="modal fade" id="modal{{ $notification['notification_id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $notification['notification_id'] }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $notification['content_notification'] }}</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td class="col-3">Notification:</td>
                                    <td class="col-9">{{ $notification['title_notification'] }}</td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Content notification:</td>
                                    <td class="col-9">{{ $notification['content_notification'] }}</td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">To:</td>
                                    <td class="col-9">
                                      @if(!empty($notification['user_names']) && count($notification['user_names']) > 0)
                                        {{ implode(', ', $notification['user_names']) }}
                                      @elseif(!empty($notification['channel_names']) && count($notification['channel_names']) > 0)
                                        {{ implode(', ', $notification['channel_names']) }}
                                      @else
                                        {{ 'Global Website' }}
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($notification['status'] === 'public')
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-danger">Inactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9">{{ date('D, d M Y', strtotime($notification['created_at'])) }}</td>
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
        <!-- /First column -->
      </div>
    </div>
  </div>
  <!-- / Content -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection
