@extends('layouts.partner_layout')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Channel Management -->
    <div class="app-ecommerce">

      <!-- Channel Title -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Channels</h4>
        </div>
      </div>

      <div class="row">

        <!-- Channel List -->
        <div class="col-12 col-lg-12">
          <!-- Channel Table -->
          <div class="card mb-6">
            <div class="card-body">
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Time</th>
                    <th>About</th>
                    <th>Banner</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($channels as $channel)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-label-info my-1">{{ date('D, d M Y', strtotime($channel->created_at)) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="align-items-center">
                        <p class="mb-0 text-truncate-3 ms-3 w-100">
                          {{ Str::limit(strip_tags($channel->about), 100) }}
                      </p>
                      </div>
                    </td>
                    <td class="bg-light rounded">
                      @if($channel->banner_url)
                        <img src="{{ asset('storage/' . $channel->banner_url) }}" alt="Banner" class="img-fluid">
                      @else
                        <img src="{{ asset('images/default-banner.jpg') }}" alt="Default Banner" class="img-fluid">
                      @endif
                    </td>
                    <td>
                      <div class="container">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill " data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li data-bs-toggle="modal" data-bs-target="#modal{{ $channel->channel_id }}">
                              <a class="dropdown-item" href="#"><i class="fa-solid fa-eye me-1"></i> View</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('partners.edit.infomation', $channel->channel_id) }}"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</a>
                            </li>
                            
                          </ul>
                        </div>
                      </div>

                      <!-- Channel Detail Modal -->
                      <div class="modal fade" id="modal{{ $channel->channel_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $channel->channel_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Details of {{ $channel->name_channel }}</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td class="col-3">Channel:</td>
                                    <td class="col-9"> {{ Str::limit(strip_tags($channel->about), 100) }}</td>
                                   
                                  </tr>
                                 
                                  <tr>
                                    <td class="col-3">Banner:</td>
                                    <td class="col-9">
                                      @if($channel->banner_url)
                                        <img src="{{ asset('storage/' . $channel->banner_url) }}" alt="Banner" class="img-fluid">
                                      @else
                                        <img src="{{ asset('images/default-banner.jpg') }}" alt="Default Banner" class="img-fluid">
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
        <!-- /Channel List -->
      </div>

    </div>
  </div>
  <!-- /Content -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@push('scripts')

@endpush
