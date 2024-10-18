
<div class="container">
    <h1>Create Channel</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('channels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token -->
        
        <div class="mb-3">
            <label for="name_channel" class="form-label">Channel Name</label>
            <input type="text" class="form-control" id="name_channel" name="name_channel" required>
        </div>

        <div class="mb-3">
            <label for="image_channel" class="form-label">Channel Image</label>
            <input type="file" class="form-control" id="image_channel" name="image_channel" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" maxlength="12">
        </div>

        <button type="submit" class="btn btn-primary">Create Channel</button>
    </form>
</div>
