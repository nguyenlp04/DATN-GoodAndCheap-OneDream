@extends('layouts.admin')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
      <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Add Notification -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
          <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1">Notification</h4>
          </div>
          <div class="d-flex align-content-center flex-wrap gap-4">
            <div class="d-flex gap-4">  
              <button type="button" class="btn btn-label-primary" onclick="window.location='{{ route('notifications.index') }}'">Cancel</button>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-send-notification">Send Notification</button>
          </div>
        </div>

        <div class="row">
          <!-- First column-->
          <div class="col-12 col-lg-7">
            <!-- Notification Information -->
            <div class="card mb-6">
              <div class="card-header">
                <h5 class="card-title mb-0">Notification Information</h5>
              </div>
              @if ($errors->has('selected_users'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('selected_users') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <div class="card-body">
                <div class="mb-6">
                  <label class="form-label" for="title_notification">Title</label>
                  <input type="text" class="form-control" id="title_notification" placeholder="Title notification" name="title_notification" value="{{ old('title_notification') }}" aria-label="Notification title">
                </div>
                <!-- Description -->
                <div>
                  <label for="content_notification" class="form-label">Content</label>
                  <textarea class="form-control" name="content_notification" id="editor" rows="5" placeholder="Content notification">{{ old('content_notification') }}</textarea>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Second column -->
          <div class="col-12 col-lg-5">
            <!-- Target Audience -->
            <div class="card mb-6">
              <div class="card-header">
                <h5 class="card-title mb-0">Select Audience</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="recipient-type">Send To</label>
                  <select id="recipient-type" name="type" class="form-select" required>
                    @foreach(App\Models\Notification::getTypeOptions() as $key => $value)
                      <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

              <!-- Select Users -->
<div id="user-list" class="mb-3" style="display: none;">
    <label class="form-label">Select Users:</label>
    <div id="user-checkboxes">
        @foreach($users as $user)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="user-{{ $user->user_id }}" name="selected_users[]" value="{{ $user->user_id }}">
                <label class="form-check-label" for="user-{{ $user->user_id }}">{{ $user->full_name }}</label>
            </div>
        @endforeach
    </div>
</div>

<!-- Select Channels -->
<div id="channel-list" class="mb-3" style="display: none;">
    <label class="form-label">Select Channels:</label>
    <div id="channel-checkboxes">
        @foreach($channels as $channel)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="channel-{{ $channel->channel_id }}" name="selected_channels[]" value="{{ $channel->channel_id }}">
                <label class="form-check-label" for="channel-{{ $channel->channel_id }}">{{ $channel->name_channel }}</label>
            </div>
        @endforeach
    </div>
</div>


              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
<script>
  document.getElementById('recipient-type').addEventListener('change', function() {
    const userList = document.getElementById('user-list');
    const channelList = document.getElementById('channel-list');
    if (this.value === 'user') {
      userList.style.display = 'block';
      channelList.style.display = 'none';
    } else if (this.value === 'channel') {
      channelList.style.display = 'block';
      userList.style.display = 'none';
    } else {
      userList.style.display = 'none';
      channelList.style.display = 'none';
    }
});

</script>

@endsection
