@extends('layouts.admin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">

        <form action="{{ route('channels.update', $channels->channel_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="app-ecommerce" data-select2-id="21">

                <!-- Edit Channel -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edit Channel</h4>
                    </div>

                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4">  
                            <button type="button" class="btn btn-label-primary" onclick="window.location='{{ url('channels') }}'">Cancel</button>
                          </div>
                        <button type="submit" class="btn btn-primary" id="update-channel">Update Channel</button>
                    </div>

                </div>

                <div class="row" data-select2-id="20">

                    <!-- Channel Information -->
                    <div class="col-12 col-lg-8">
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Channel Information</h5>
                            </div>
                            <div class="card-body">

                                <div class="mb-6">
                                    <label for="name_channel" class="form-label">Channel Name:</label>
                                    <input type="text" name="name_channel" class="form-control" id="name_channel" value="{{ $channels->name_channel }}" required placeholder="Enter channel name">
                                </div>

                                <div class="mb-6">
                                    <label for="address" class="form-label">Channel Address:</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{ $channels->address }}" required placeholder="Enter channel address">
                                </div>

                                <div class="mb-6">
                                    <label for="phone_number" class="form-label">Phone Number:</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $channels->phone_number }}" required placeholder="Enter phone number">
                                </div>

                                <div class="mb-6">
                                    <label for="status" class="form-label">Status:</label>
                                    <select name="status" class="form-select" id="status" required>
                                        <option value="1" {{ $channels->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $channels->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="vip_package_id" class="form-label">VIP Package:</label>
                                    <select name="vip_package_id" class="form-select" id="vip_package_id">
                                        <option value="NULL" {{ is_null($channels->vip_package_id) ? 'selected' : '' }}>None</option>
                                        @foreach ($vipPackages as $vipPackage)
                                            <option value="{{ $vipPackage->id }}" {{ $channels->vip_package_id == $vipPackage->id ? 'selected' : '' }}>
                                                {{ $vipPackage->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="mb-6">
                                    <label for="vip_start_at" class="form-label">VIP Start Date:</label>
                                    <input type="date" name="vip_start_at" class="form-control" id="vip_start_at" value="{{ $channels->vip_start_at }}">
                                </div>

                                <div class="mb-6">
                                    <label for="vip_end_at" class="form-label">VIP End Date:</label>
                                    <input type="date" name="vip_end_at" class="form-control" id="vip_end_at" value="{{ $channels->vip_end_at }}">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Channel Image -->
                    <div class="col-12 col-lg-4">
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Channel Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="dropzone p-0 dz-clickable" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 11.5rem;">
                                    <img id="preview_img" src="{{ asset($channels->image_channel) }}" class="mt-3 rounded" style="width: 100px; height: auto;">
                                    <div style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnBrowse">Browse image</button>
                                        <input type="file" id="fileInput" name="image_channel" style="display: none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@section('script-link-css')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>

<script>
    document.getElementById('btnBrowse').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('fileInput');
        const previewImg = document.getElementById('preview_img');

        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                previewImg.classList.add('hidden');
            }
        });
    });
</script>
@endsection
