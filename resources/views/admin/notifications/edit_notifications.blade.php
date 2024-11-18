@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
      <form action="{{ route('notifications.update', $notifications->notification_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
          <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1">Edit Notification</h4>
          </div>
          <div class="d-flex align-content-center flex-wrap gap-4">
            <div class="d-flex gap-4">  
              <button type="button" class="btn btn-label-primary" onclick="window.location='{{ route('notifications.index') }}'">Cancel</button>
            </div>
            <button type="submit" class="btn btn-primary">Update Notification</button>
          </div>
        </div>

        <div class="row">
          <!-- Left Column -->
          <div class="col-12 col-lg-7">
            <div class="card mb-6">
              <div class="card-header">
                <h5 class="card-title mb-0">Notification Information</h5>
              </div>
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
                  <input type="text" class="form-control" id="title_notification" placeholder="Title notification" name="title_notification" value="{{ old('title_notification', $notifications->title_notification) }}">
                </div>
                <div>
                  <label for="content_notification" class="form-label">Content</label>
                  <textarea class="form-control" name="content_notification" id="editor" rows="10">{{ old('content_notification', $notifications->content_notification) }}</textarea>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Right Column -->
          <div class="col-12 col-lg-5">
            <div class="card mb-6">
              <div class="card-header">
                <h5 class="card-title mb-0">Select Audience</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="recipient-type">Send To</label>
                  <select id="recipient-type" name="type" class="form-select" required>
                    @foreach(App\Models\Notification::getTypeOptions() as $key => $value)
                      <option value="{{ $key }}" {{ old('type', $notifications->type) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- Select Users -->
                <div id="user-list" class="mb-3" style="{{ old('type', $notifications->type) === 'user' ? '' : 'display: none;' }}">
                  <label class="form-label">Select Users:</label>
                  @foreach($users as $user)
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="user-{{ $user->user_id }}" name="selected_users[]" value="{{ $user->user_id }}" 
                      {{ in_array($user->user_id, $notifications->selected_users ?? []) ? 'checked' : '' }}>
                      <label class="form-check-label" for="user-{{ $user->user_id }}">{{ $user->full_name }}</label>
                    </div>
                  @endforeach
                </div>

                <!-- Select Channels -->
                <div id="channel-list" class="mb-3" style="{{ old('type', $notifications->type) === 'channel' ? '' : 'display: none;' }}">
                  <label class="form-label">Select Channels:</label>
                  @foreach($channels as $channel)
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="channel-{{ $channel->channel_id }}" name="selected_channels[]" value="{{ $channel->channel_id }}" 
                      {{ in_array($channel->channel_id, $notifications->selected_channels ?? []) ? 'checked' : '' }}>
                      <label class="form-check-label" for="channel-{{ $channel->channel_id }}">{{ $channel->name_channel }}</label>
                    </div>
                    
                    
                  @endforeach
                </div>
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select id="status" name="status" class="form-select" required>
                    <option value="public" {{ old('status', $notifications->status) === 'public' ? 'selected' : '' }}>Active</option>
                    <option value="private" {{ old('status', $notifications->status) === 'private' ? 'selected' : '' }}>Deactive	
                    </option>
                  </select>
                </div>
              </div>
              
            </div>
            
          </div>
          
        </div>
      </form>
    </div>
  </div>
</div>

@section('script-link-css')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
@endsection

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
