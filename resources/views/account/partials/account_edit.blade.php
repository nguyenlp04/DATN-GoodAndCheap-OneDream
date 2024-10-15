<form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Đừng quên thêm CSRF token -->

    <!-- Current Profile Picture -->
    <label>Current Profile Picture</label><br>
    <div style="display: flex; flex-direction: column; align-items: center; ">
        <div style="position: relative;">
            @if (Auth::user()->image_user)
            <img id="profile-picture" src="{{ asset('storage/' . Auth::user()->image_user) }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            @else
            <img id="profile-picture" src="{{ asset('storage/image_users/default_avatar.jpg') }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            @endif
            <label for="image_user" style="position: absolute; bottom: 5px; right: 5px; background-color: #DCA766; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <i class="fa-solid fa-pen"></i>
                <input type="file" id="image_user" name="image_user" class="d-none" accept="image/*">
            </label>
        </div>
    </div>

    <script>
        document.getElementById('image_user').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy tệp hình ảnh đầu tiên
            if (file) {
                const reader = new FileReader(); // Tạo đối tượng FileReader

                reader.onload = function(e) {
                    // Cập nhật thuộc tính src của thẻ img với hình ảnh mới
                    document.getElementById('profile-picture').src = e.target.result;
                }

                reader.readAsDataURL(file); // Đọc tệp hình ảnh
            }
        });
    </script>
    <br>

    <!-- Display Name -->
    <label>Display Name *</label>
    <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->full_name }}">
    @error('full_name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

    <!-- Email Address -->
    <label>Email address *</label>
    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
    @error('email')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <!-- Address -->
    <label>Your address *</label>
    <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
    @error('address')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <!-- Phone -->
    <label>Your phone number *</label>
    <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
    @error('phone_number')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <!-- Submit Button -->
    <button type="submit" class="btn btn-outline-primary-2">
        <span>SAVE CHANGES</span>
        <i class="icon-long-arrow-right"></i>
    </button>
</form>