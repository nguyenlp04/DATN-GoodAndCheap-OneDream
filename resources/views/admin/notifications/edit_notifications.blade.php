@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="app-ecommerce">

                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div>
                        <h4 class="mb-1">Edit Notification</h4>
                    </div>
                    <div>
                        <a href="{{ route('notifications.index') }}" class="btn btn-label-secondary">Cancel</a>
                        <button type="submit" form="edit-notification-form" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>

                <!-- Edit Notification Form -->
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Notification Information</h5>
                            </div>
                            <div class="card-body">
                                <!-- Success Message -->
                                @if (session('alert'))
                                    <div class="alert alert-{{ session('alert.type') }}">
                                        {{ session('alert.message') }}
                                    </div>
                                @endif

                                <!-- Form -->
                                <form id="edit-notification-form" action="{{ route('notifications.update', $notifications->notification_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id="title" name="title_notification" class="form-control" value="{{ old('title_notification', $notifications->title_notification) }}" placeholder="Enter notification title">
                                        @error('title_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Content -->
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                  {{-- <textarea class="form-control" name="content_notification" id="editor" rows="5" placeholder="Content notification">{{ old('content_notification') }}</textarea> --}}

                                        <textarea id="editor" name="content_notification" class="form-control" rows="5" placeholder="Enter notification content">{{ old('content_notification', $notifications->content_notification) }}</textarea>
                                        @error('content_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="public" {{ old('status', $notifications->status) == 'public' ? 'selected' : '' }}>Public</option>
                                            <option value="private" {{ old('status', $notifications->status) == 'private' ? 'selected' : '' }}>Private</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Type -->
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="website" {{ old('type', $notifications->type) == 'website' ? 'selected' : '' }}>Website</option>
                                            <option value="user" {{ old('type', $notifications->type) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="channel" {{ old('type', $notifications->type) == 'channel' ? 'selected' : '' }}>Channel</option>
                                        </select>
                                        @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Notification Image</label>
                                        <input type="file" name="image_notification" id="image" class="form-control">
                                        @if ($notifications->image_notification)
                                            <img src="{{ asset('storage/' . $notifications->image_notification) }}" alt="Notification Image" class="mt-2" style="max-width: 100px;">
                                        @endif
                                        @error('image_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Assigned Users or Channels -->
                                    <div class="mb-3">
                                        <label class="form-label">Assign To</label>
                                        <div id="assign-users-channels" class="row">
                                            @if ($notifications->type == 'user')
                                            <label class="form-label">Select Users:</label>
                                            <div id="user-checkboxes">
                                                @foreach ($users as $user)
                                                    <div class="form-check">
                                                        <input 
                                                            type="checkbox" 
                                                            class="form-check-input" 
                                                            id="user-{{ $user->user_id }}" 
                                                            name="selected_users[]" 
                                                            value="{{ $user->user_id }}" 
                                                            {{ is_array($notifications->selected_users) && in_array($user->user_id, $notifications->selected_users) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="user-{{ $user->user_id }}">{{ $user->full_name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($notifications->type == 'channel')
                                        <label class="form-label">Select Channels:</label>
                                        <div id="channel-checkboxes">
                                            @foreach ($channels as $channel)
                                                <div class="form-check">
                                                    <input 
                                                        type="checkbox" 
                                                        class="form-check-input" 
                                                        id="channel-{{ $channel->channel_id }}" 
                                                        name="selected_channels[]" 
                                                        value="{{ $channel->channel_id }}" 
                                                        {{ is_array($notifications->selected_channels) && in_array($channel->channel_id, $notifications->selected_channels) ? 'checked' : 'No found channel have this notification' }}>
                                                    <label class="form-check-label" for="channel-{{ $channel->channel_id }}">{{ $channel->name_channel }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    

                                        </div>
                                        @error('selected_users')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('selected_channels')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">Update Notification</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-backdrop fade"></div>
    </div>
    @section('script-link-css')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
@endsection
    <script>
        document.getElementById('type').addEventListener('change', function() {
        const userList = document.getElementById('user-checkboxes');
        const channelList = document.getElementById('channel-checkboxes');
    
        if (this.value === 'user') {
            userList.style.display = 'block';
            channelList.style.display = 'none';
        } else if (this.value === 'channel') {
            userList.style.display = 'none';
            channelList.style.display = 'block';
        } else {
            userList.style.display = 'none';
            channelList.style.display = 'none';
        }
    });
    document.getElementById('type').dispatchEvent(new Event('change'));
    
    </script>
@endsection


