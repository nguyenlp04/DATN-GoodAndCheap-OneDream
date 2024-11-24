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
                        <a class="nav-link" href="{{ url('manage-profile') }}"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('change-password') }}"><i class="fas fa-key me-1"></i> Change password</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="{{ Auth::guard('staff')->user()->avata ? asset(Auth::guard('staff')->user()->avata) : asset('/admin/assets/img/avatars/1.png') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                                style="object-fit: cover;" />
                            <div class="button-wrapper">

                                <p class="text-muted mb-0">{{ Auth::guard('staff')->user()->role }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formChangePassword" method="POST" action="{{ route('change-password.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Current Password Field -->
                                    <div class="mb-3 col-md-6">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <input class="form-control" type="password" id="currentPassword" name="current_password" required />
                                        @error('current_password')
                                        <div class="text-danger">
                                            <i class="bx bx-error-circle me-2"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- New Password Field -->
                                    <div class="mb-3 col-md-6">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input class="form-control" type="password" id="newPassword" name="new_password" required />
                                        @error('new_password')
                                        <div class="text-danger">
                                            <i class="bx bx-error-circle me-2"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Confirm New Password Field -->
                                    <div class="mb-3 col-md-6">
                                        <label for="newPasswordConfirmation" class="form-label">Confirm New Password</label>
                                        <input class="form-control" type="password" id="newPasswordConfirmation" name="new_password_confirmation" required />
                                        @error('new_password_confirmation')
                                        <div class="text-danger">
                                            <i class="bx bx-error-circle me-2"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
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