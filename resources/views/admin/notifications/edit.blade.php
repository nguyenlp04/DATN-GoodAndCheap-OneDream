@extends('layouts.admin')
@section('content')
<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->
    <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="{{ url("javascript:void(0)") }}">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                        type="text"
                        class="form-control border-0 shadow-none"
                        placeholder="Search..."
                        aria-label="Search..." />
                </div>
            </div>
            <!-- /Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="{{ url("javascript:void(0);") }}" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ url("#") }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">John Doe</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url("profile.html") }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url("#") }}">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url("#") }}">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url("auth-login-basic.html") }}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


            <div class="app-ecommerce" data-select2-id="21">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edit notification</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                            <button class="btn btn-label-primary">Save draft</button>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish </button>
                    </div>

                </div>

                <div class="row" data-select2-id="20">

                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- notification Information -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">notification information</h5>
                                <!-- Các nút nằm ngang hàng với tiêu đề -->
                                <div>

                                    
                               
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Hiển thị thông báo thành công -->
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <!-- For sửa thêm notification -->
                                <form action="{{ route('notifications.update', $notifications->notification_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') 
                                    <div class="mb-6">
                                        <label class="form-label">Title:</label>
                                        <input type="text" name="title" class="form-control mb-3" placeholder="Enter notification title" value="{{ old('title', $notifications->title) }}">
                                        @if ($errors->has('title'))
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                
                                        <label class="form-label">Content:</label>
                                        <textarea name="content" class="form-control mb-3">{{ old('content', $notifications->content) }}</textarea>
                                        @if ($errors->has('content'))
                                            <div class="text-danger">{{ $errors->first('content') }}</div>
                                        @endif
                                
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-select mb-2">
                                            <option value="public" {{ old('status', $notifications->status) == 'public' ? 'selected' : '' }}>Public</option>
                                            <option value="private" {{ old('status', $notifications->status) == 'private' ? 'selected' : '' }}>Private</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
                                
                                        <label for="type">Type:</label>
                                        <select name="type" id="type" class="form-select mb-2">
                                            <option value="website" {{ old('type', $notifications->type) == 'website' ? 'selected' : '' }}>Website</option>
                                            <option value="user" {{ old('type', $notifications->type) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="channel" {{ old('type', $notifications->type) == 'channel' ? 'selected' : '' }}>Channel</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <div class="text-danger">{{ $errors->first('type') }}</div>
                                        @endif
                                
                                        <label class="form-label">Image:</label>
                                        <input type="file" name="image" class="form-control mb-3">
                                        <img src="{{ asset('storage/' . $notifications->image) }}" alt="notification Image" style="width: 70px; height: auto;">
                                        @if ($errors->has('image'))
                                            <div class="text-danger">{{ $errors->first('image') }}</div>
                                        @endif
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Update notification</button>
                                </form>
                                

                              
                            </div>
                        </div>
                        
                        
                        
                    </div>
                  
                    

                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://OneDream.com" target="_blank" class="footer-link fw-bolder">OneDream</a>
                </div>

            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>
@endsection