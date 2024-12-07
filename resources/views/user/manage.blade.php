@extends('layouts.client_layout')
@section('content')
<style>
    @media (max-width: 768px) {
        #profile-picture {
            width: 100px;
            height: 100px;
        }

        label[for="image_user"] {
            width: 25px;
            height: 25px;
        }

        form label,
        form input,
        form small,
        form button {
            font-size: 14px;
        }

        form .form-control {
            padding: 8px;
        }
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row justify-content-Start">
                    <div class="col col-md-9 col-lg-7 col-xl-5">
                        <div style="width:  fit-content;min-width:430px; ">
                            <div class="card-body" style="padding: 0.4rem 1.5rem 1.8rem 1.2rem;">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Auth::user()->image_user ? asset(Auth::user()->image_user) : 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp' }}"
                                            alt="Generic placeholder image" class="img-fluid" style="width: 120px;  border-radius: 10px;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ Auth::user()->full_name }}</h5>

                                        <p style="color: #ff0000;"><i class="fa-solid fa-face-smile" style="color: #FFD43B;"></i> Become a partner for easier management </p>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary  " style="width: fit-content">
                                            <div>
                                                <p class="small text-muted"><i class="fa-solid fa-clock" style="color: #74C0FC;"></i>
                                                    @if ($diffInMonths > 0)
                                                    <strong>{{ $diffInMonths }}</strong> month <strong>{{ $diffInDays }}</strong> day.
                                                    @else
                                                    <strong>{{ $diffInDays }}</strong> day.
                                                    @endif
                                                </p>
                                                {{-- <p class="small text-muted "><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> 56</p> --}}
                                                <p class="small text-muted "> <i class="fa-solid fa-file-invoice-dollar" style="color: #74C0FC;"></i> {{ $transactionCount}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-xl-7 col-lg-10">
                        <div class="tabs-vertical">
                            <ul class="nav nav-tabs flex-column" id="tabs-8" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ !$errors->updatePassword->any() ? 'active' : '' }}"
                                        id="tab-Edit_Profile-tab" data-toggle="tab" href="#tab-Edit_Profile" role="tab"
                                        aria-controls="tab-Edit_Profile" aria-selected="{{ !$errors->updatePassword->any() ? 'true' : 'false' }}">
                                        Edit Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-Follow_List-tab" data-toggle="tab" href="#tab-Follow_List" role="tab" aria-controls="tab-Follow_List" aria-selected="true">Follow List</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->updatePassword->any() ? 'active' : '' }}"
                                        id="tab-Edit_Password-tab" data-toggle="tab" href="#tab-Edit_Password" role="tab"
                                        aria-controls="tab-Edit_Password" aria-selected="{{ $errors->updatePassword->any() ? 'true' : 'false' }}">
                                        Edit Password
                                    </a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="tab-Details-tab" data-toggle="tab" href="#tab-Details" role="tab" aria-controls="tab-Details" aria-selected="false">Details</a>
                                </li> -->
                            </ul>
                            <div class="tab-content tab-content-border" id="tab-content-8">
                                <div class="tab-pane fade {{ !$errors->updatePassword->any() ? 'show active' : '' }}" id="tab-Edit_Profile" role="tabpanel" aria-labelledby="tab-Edit_Profile-tab">
                                    <!-- <p>Nobis perspiciatis natus cum, sint dolore earum rerum tempora aspernatur numquam velit tempore omnis, delectus repellat facere voluptatibus nemo non fugiat consequatur repellendus! Enim, commodi, veniam ipsa voluptates quis amet.</p> -->
                                    <form action="{{ route('user.manage.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf <!-- Đừng quên thêm CSRF token -->
                                        <!-- Current Profile Picture -->
                                        <!-- <h6>Edit Personal Information</h6><br> -->
                                        <div class="mb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                            <h6 class="mb-3 mb-md-0">Edit Personal Information</h6>
                                            <button type="submit" class="btn btn-outline-primary-2 px-2 py-3 w-md-auto " id="btn-publish-profile">Save Changes</button>
                                        </div>

                                        <div class="text-center">
                                            <div class="position-relative d-inline-block">
                                                @if (Auth::user()->image_user)
                                                <img id="profile-picture" src="{{ asset(Auth::user()->image_user) }}" alt="Profile Picture"
                                                    class="rounded-circle img-fluid" style="width: 125px; height: 125px; object-fit: cover;">
                                                @else
                                                <img id="profile-picture" src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="Profile Picture"
                                                    class="rounded-circle img-fluid" style="width: 125px; height: 125px; object-fit: cover;">
                                                @endif
                                                <label for="image_user"
                                                    class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                    style="bottom: 0px; right: 5px; width: 25px; height: 25px; cursor: pointer;">
                                                    <i class="fa-solid fa-pen"></i>
                                                    <input type="file" id="image_user" name="image_user" class="d-none" accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                        @error('image_user')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                        <!-- Display Name -->
                                        <!-- <label>Display Name *</label> -->
                                        <label class="font-weight-bold form-label" for="ecommerce-name">Display Name *</label>
                                        <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->full_name }}" placeholder="Display Name *" aria-label="Display Name *">
                                        @error('full_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>
                                        <!-- Email Address -->
                                        <!-- <label>Email address *</label> -->
                                        <label class="font-weight-bold form-label" for="ecommerce-name">Email address *</label>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email address *" aria-label="Email address *">
                                        @error('email')
                                        <div class=" text-danger">{{ $message }}
                                        </div>
                                        @enderror
                                        <!-- Address -->
                                        <!-- <label>Your address *</label> -->
                                        <label class="font-weight-bold form-label" for="ecommerce-name">Your address *</label>
                                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}" placeholder="Your address *" aria-label="Your address *">
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <!-- Phone -->
                                        <!-- <label>Your phone number *</label> -->
                                        <label class="font-weight-bold form-label" for="ecommerce-name">Your phone number *</label>
                                        <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" placeholder="Your phone number *" aria-label="Your phone number *">
                                        @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="tab-Follow_List" role="tabpanel" aria-labelledby="tab-Follow_List-tab">
                                    <div class="row">
                                        <div class="m-0 d-flex justify-content-between align-items-center">
                                            <h6>Watchlist ...</h6>
                                        </div>
                                        @if($followedChannels->isEmpty())
                                        <p class="text-center mt-4">watchlist is empty.</p>
                                        @else
                                        @foreach($followedChannels as $followedChannel)
                                        <div class="m-2 d-flex justify-content-between align-items-center" id="channel-{{ $followedChannel->channel->channel_id }}">
                                            <a href="{{ url('/channels/' . $followedChannel->channel->channel_id) }}" class="d-flex align-items-center text-decoration-none text-dark">
                                                <img src="{{ $followedChannel->channel->image_channel ? asset($followedChannel->channel->image_channel) : 'https://via.placeholder.com/50' }}"
                                                    alt="Avatar" class="rounded me-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <span>{{ $followedChannel->channel->name_channel }}</span>
                                            </a>
                                            <button class="btn btn-danger btn-sm btn-rounded unfollow-btn"
                                                data-channel-id="{{ $followedChannel->channel->channel_id }}"
                                                style="min-width: 100px;">
                                                <i class="fa-solid fa-user-minus me-2"></i> Unfollow
                                            </button>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade {{ $errors->updatePassword->any() ? 'show active' : '' }}" id="tab-Edit_Password" role="tabpanel" aria-labelledby="tab-Edit_Password-tab">
                                    <section>
                                        <form action="{{ route('password.update') }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('PUT')
                                            <header class="mt-2">
                                                <div class="mb-2 d-flex justify-content-between">
                                                    <h6 class="">Update Password</h6><!-- End .checkout-title -->
                                                    <button type="submit" class="btn btn-outline-primary-2 px-2 py-3 w-md-auto " id="btn-publish-password">{{ __('Change Password') }}</button>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                                </p>
                                            </header>
                                            <!-- Current Password -->
                                            <label class="font-weight-bold form-label" for="ecommerce-name">{{ __('Current Password') }} *</label>
                                            <input type="password" class="form-control" name="current_password" required>
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" class="mt-2 text-danger" />

                                            <!-- New Password -->
                                            <label class="font-weight-bold form-label" for="ecommerce-name">{{ __('New Password') }} *</label>
                                            <input type="password" class="form-control" name="password" required>
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" class="mt-2 text-danger" />
                                            <!-- Confirm Password -->
                                            <label class="font-weight-bold form-label" for="ecommerce-name">{{ __('Confirm New Password') }} *</label>
                                            <input type="password" class="form-control mb-2" name="password_confirmation" required>
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                                            <!-- Success Message -->
                                            @if (session('status') === 'password-updated')
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
                                                {{ __('Saved.') }}
                                            </p>
                                            @endif
                                        </form>
                                    </section>
                                </div><!-- .End .tab-pane -->
                                <!-- <div class="tab-pane fade" id="tab-Details" role="tabpanel" aria-labelledby="tab-Details-tab">
                                    <h6 style="margin-left: 20px; padding-right: 100px;">Your Details Information</h6>
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                            <h3 class="card-title">Details</h3>
                                            <p>Full name: {{ Auth::user()->full_name }}<br>
                                                Address: {{ Auth::user()->address }}<br>
                                                Phone: {{Auth::user()->phone_number}}<br>
                                                Email: {{Auth::user()->email}}<br>
                                                <a id="tab-Edit_Profile-tab" data-toggle="tab" href="#tab-Edit_Profile" role="tab"
                                                    aria-controls="tab-Edit_Profile">Edit <i class="icon-edit"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div> -->
                            </div><!-- End .tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script-link-css')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unfollowButtons = document.querySelectorAll('.unfollow-btn');

        unfollowButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn form submit mặc định
                const channelId = this.dataset.channelId;

                fetch(`/unfollow/${channelId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json(); // Phân tích JSON nếu API thành công
                        } else {
                            throw new Error('Server error: ' + response.status); // Thông báo lỗi cụ thể
                        }
                    })
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo thành công
                            Swal.fire({
                                icon: 'success',
                                title: 'Unfollowed successfully',
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });

                            // Xóa kênh khỏi giao diện
                            const channelElement = document.getElementById(`channel-${channelId}`);
                            channelElement.remove();
                        } else {
                            // Hiển thị thông báo lỗi từ server
                            Swal.fire({
                                icon: 'error',
                                title: data.message || 'An error occurred.',
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Hiển thị thông báo lỗi chung
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong. Please try again later.',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
            });
        });
    });
</script>

@endsection