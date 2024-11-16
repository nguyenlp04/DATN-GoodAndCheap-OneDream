@extends('layouts.client_layout')

@section('content')

<style>
.custom-dropzone {
    border: 2px dashed #ddd;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    background-color: #f9f9f9;
    transition: border-color 0.3s, background-color 0.3s;
}



.dz-preview img {
    max-width: 100px;
    border-radius: 5px;
    margin: 5px;
}

.dz-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #fff;
    color: #dc3545;
    border-radius: 50%;
    font-size: 14px;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.dz-remove:hover {
    background-color: #dc3545;
    color: #fff;
}
</style>

<main class="main container pt-5">
    <div class="form-container">
        <h3 class="mb-4">Create Product Channel</h3>
        <form action="{{ route('channels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Channel Name & Phone Number -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name_channel" class="form-label">Channel Name:</label>
                    <input type="text" class="form-control" id="name_channel" name="name_channel" placeholder="Enter channel name" value="{{ old('name_channel') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}" required>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <label for="image_channel" class="form-label">Image Store</label>
                </div>
                <div class="card-body">
                    <div class="custom-dropzone" id="dropzone">
                        <button type="button" class="btn btn-outline-primary mt-3 dz-browse-btn">Upload image</button>
                        <input type="file" name="image_channel" multiple accept="image/*" style="display: none;">
                        <div id="image-preview" class="mt-3"></div> <!-- Đoạn này dùng để hiển thị ảnh -->
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-2">Create Channel</button>
                <button type="button" class="btn btn-success">Cancel</button>
            </div>
        </form>
    </div>
</main>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropzone = document.getElementById("dropzone");
        const inputFile = dropzone.querySelector('input[type="file"]');
        const imagePreview = document.getElementById("image-preview");

        // Khi nhấn vào nút "Upload image"
        dropzone.querySelector(".dz-browse-btn").addEventListener("click", function() {
            inputFile.click();
        });

        // Hiển thị ảnh ngay khi người dùng chọn
        inputFile.addEventListener("change", function(event) {
            imagePreview.innerHTML = "";  // Xóa ảnh cũ
            const files = event.target.files;

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "100px";
                    img.style.margin = "5px";
                    img.style.borderRadius = "5px";
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // Khởi tạo Dropzone
        new Dropzone(dropzone, {
            paramName: "image_channel", // Đảm bảo paramName trùng với tên input file
            maxFiles: 5, // Số lượng file tối đa
            acceptedFiles: "image/*", // Chỉ chấp nhận file ảnh
            addRemoveLinks: true, // Cho phép xóa file đã chọn
        });
    });

</script>


@endsection
