@extends('layouts.admin')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> -->

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('manage-profile') }}"><i class="bx bx-user me-1"></i>
                                Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('change-password') }}"><i class="fas fa-key me-1"></i> Change
                                password</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" action="{{ route('manage-profile.update') }}"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="card-body py-3 ps-0">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="{{ Auth::guard('staff')->user()->avata ? asset(Auth::guard('staff')->user()->avata) : asset('/admin/assets/img/avatars/1.png') }}"
                                            alt="user-avatar" class="d-block rounded" height="100" width="100"
                                            id="uploadedAvatar" style="object-fit: cover;" />
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">Upload new photo</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" name="avata" id="upload"
                                                    class="account-file-input" hidden
                                                    accept="image/png, image/jpeg, image/jpg" />
                                            </label>
                                            <button type="button"
                                                class="btn btn-outline-secondary account-image-reset mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Reset</span>
                                            </button>
                                            <p class="text-muted mb-0">{{ Auth::guard('staff')->user()->role }}</p>
                                        </div>
                                    </div>
                                    @error('avata')
                                        <div class="text-danger">
                                            <i class="bx bx-error-circle me-2"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <hr class="my-0 mb-4" />
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" id="firstName" name="full_name"
                                            value="{{ Auth::guard('staff')->user()->full_name }}" autofocus />
                                        @error('full_name')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ Auth::guard('staff')->user()->email }}"
                                            placeholder="john.doe@example.com" />
                                        @error('email')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ Auth::guard('staff')->user()->address }}" placeholder="Address" />
                                        @error('address')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status"
                                            value="{{ Auth::guard('staff')->user()->status == 1 ? 'Activate' : 'Lock' }}"
                                            placeholder="status" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Active from date</label>
                                        <input type="text" class="form-control" id="Creation Date" name="Creation Date"
                                            value="
                                    {{ Auth::guard('staff')->user()->created_at ? Auth::guard('staff')->user()->created_at->format('d/m/Y') : null }}"
                                            placeholder="Creation Date" readonly />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
@endsection
@section('script-link-css')
    <script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>
@endsection
