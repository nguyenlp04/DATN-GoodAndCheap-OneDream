@extends('layouts.admin')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="app-ecommerce">

      <!-- Page Header -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Trash - Deleted Notifications</h4>
        </div>
      </div>

      <div class="row">

        <!-- Trash Table -->
        <div class="col-12 col-lg-12">
          <div class="card mb-6">
            <div class="card-body">
              <table id="trashTable" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Deleted By</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($notifications as $notification)
                  <tr>
                    <td>
                      <span class="badge bg-info">ID: {{ $notification->notification_id }}</span>
                    </td>
                    <td>{{ $notification->title_notification }}</td>
                    <td>{{ $notification->deleted_by ?? 'System' }}</td>
                    <td>{{ $notification->deleted_at->format('D, d M Y') }}</td>
                    <td>
                      <div class="container">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <!-- Restore Action -->
                            <li>
                              <form action="{{ route('notifications.restore', $notification->notification_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                  <span><i class="fa-solid fa-undo me-1"></i></span>Restore
                                </button>
                              </form>
                            </li>
                            <!-- Permanent Delete Action -->
                            <li>
                              <form action="{{ route('notifications.forceDelete', $notification->notification_id) }}" method="POST" onsubmit="return confirmPermanentDelete()" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                  <span><i class="fa-solid fa-trash me-1"></i></span>Delete Permanently
                                </button>
                              </form>
                            </li>
                          </ul>
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
        <!-- /Trash Table -->
      </div>
    </div>
  </div>
  <!-- / Content -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<script>
  function confirmPermanentDelete() {
      return confirm('Are you sure you want to permanently delete this notification? This action cannot be undone.');
  }
</script>

@endsection
