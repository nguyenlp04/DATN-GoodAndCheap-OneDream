@extends('layouts.client_layout')

@section('content')


<main class="main container ">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Channel</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content" >

        <form action="{{ route('channels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Display errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Channel name and phone number -->
            <div class="row ">
                <div class="col-md-4">
                    <label for="name_channel" class="form-label font-weight-bold">Channel Name</label>
                    <input type="text" class="form-control" id="name_channel" name="name_channel" placeholder="Enter channel name" value="{{ old('name_channel') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="phone_number" class="form-label font-weight-bold">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label font-weight-bold">Vip Package </label>
                    <select id="vip_package_id" name="vip_package_id" class="form-select form-control">
                        @foreach ($vipPackages as $item )
                        <option value="{{ $item->vip_package_id }}" >{{  $item->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Address -->
            <div class="row">
                <div class="col-md-4">
                    <label for="city" class="form-label font-weight-bold">City</label>
                    <select id="city" name="city" class="form-select form-control">
                        <option value="" selected>Select City</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="district" class="form-label font-weight-bold">District</label>
                    <select id="district" name="district" class="form-select form-control">
                        <option value="" selected>Select District</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ward" class="form-label font-weight-bold">Ward</label>
                    <select id="ward" name="wards" class="form-select form-control">
                        <option value="" selected>Select Ward</option>
                    </select>
                </div>
            </div>

            <div >
                <label for="addressDetail" class="form-label font-weight-bold">Detailed Address</label>
                <input type="text" id="addressDetail" name="address" class="form-control" placeholder="Enter detailed address" >
            </div>
            <script
            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js">
        </script>
        <link rel="stylesheet"
            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
            <!-- Upload images -->
            <div class="mb-2 ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <label for="productImage" class="form-label font-weight-bold">Product Image</label>
                </div>
                <div class="card-body rounded" style="border-style: dashed;">
                    <div class="dropzone p-0 dz-clickable"
                        style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 17.5rem;">
                        <div id="preview_images"
                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                            <!-- Các hình ảnh đã tải lên sẽ được thêm vào đây -->
                        </div>
                        <div
                            style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                id="btnBrowse">Browse image</button>
                            <input type="file" id="fileInput" name="image_channel"
                                accept="image/*" style="display: none" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="d-flex ">
                <button type="submit" class="btn btn-primary btn-rounded">Create Channel</button>

            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const citySelect = document.getElementById("city");
        const districtSelect = document.getElementById("district");
        const wardSelect = document.getElementById("ward");
        const addressDetail = document.getElementById("addressDetail");

        // Fetch cities
        fetch("https://provinces.open-api.vn/api/p/")
            .then((response) => response.json())
            .then((cities) => {
                cities.forEach((city) => {
                    const option = document.createElement("option");
                    option.value = city.code;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            });

        // Load districts when a city is selected
        citySelect.addEventListener("change", function () {
            const cityCode = citySelect.value;

            districtSelect.innerHTML = '<option value="" selected>Select District</option>';
            wardSelect.innerHTML = '<option value="" selected>Select Ward</option>';

            if (cityCode) {
                fetch(`https://provinces.open-api.vn/api/p/${cityCode}?depth=2`)
                    .then((response) => response.json())
                    .then((data) => {
                        data.districts.forEach((district) => {
                            const option = document.createElement("option");
                            option.value = district.code;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    });
            }
        });

        // Load wards when a district is selected
        districtSelect.addEventListener("change", function () {
            const districtCode = districtSelect.value;

            wardSelect.innerHTML = '<option value="" selected>Select Ward</option>';

            if (districtCode) {
                fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
                    .then((response) => response.json())
                    .then((data) => {
                        data.wards.forEach((ward) => {
                            const option = document.createElement("option");
                            option.value = ward.code;
                            option.textContent = ward.name;
                            wardSelect.appendChild(option);
                        });
                    });
            }
        });

        // Update address detail when all selections are made
        function updateAddressDetail() {
            const cityName = citySelect.options[citySelect.selectedIndex]?.text || "";
            const districtName = districtSelect.options[districtSelect.selectedIndex]?.text || "";
            const wardName = wardSelect.options[wardSelect.selectedIndex]?.text || "";

            if (cityName && districtName && wardName) {
                addressDetail.value = `${wardName}, ${districtName}, ${cityName}`;
            }
        }

        // Call the update function when any select changes
        citySelect.addEventListener("change", updateAddressDetail);
        districtSelect.addEventListener("change", updateAddressDetail);
        wardSelect.addEventListener("change", updateAddressDetail);
    });
    const dropzone = document.getElementById("dropzone");
        const inputFile = dropzone.querySelector('input[type="file"]');
        const imagePreview = document.getElementById("image-preview");

        dropzone.querySelector(".dz-browse-btn").addEventListener("click", function () {
            inputFile.click();
        });

        inputFile.addEventListener("change", function (event) {
            imagePreview.innerHTML = "";
            Array.from(event.target.files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "100px";
                    img.style.margin = "5px";
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
</script>
<script>
        let uploadedImages = [];
        document.getElementById('btnBrowse').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('fileInput');
            const previewContainer = document.getElementById('preview_images');

            function displayImages() {
                previewContainer.innerHTML = '';
                uploadedImages.forEach((imageSrc, index) => {
                    const imgContainer = document.createElement('div');
                    imgContainer.style.position = 'relative';
                    const img = document.createElement('img');
                    img.src = imageSrc;
                    img.style.width = '100px';
                    img.style.height = 'auto';
                    img.classList.add('mt-3', 'rounded');
                    const removeBtn = document.createElement('span');
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '0';
                    removeBtn.style.right = '0';
                    removeBtn.style.color = 'red';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.fontSize = '18px';
                    removeBtn.style.backgroundColor = 'white';
                    removeBtn.style.borderRadius = '50%';
                    removeBtn.style.padding = '2px 5px';
                    removeBtn.onclick = function() {

                        uploadedImages.splice(index, 1);
                        displayImages();
                    };
                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                });
            }
            input.addEventListener('change', function(event) {
                const files = event.target.files;
                if (uploadedImages.length + files.length > 5) {
                    alert('You can only upload up to 5 images.');
                    return;
                }
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            uploadedImages.push(e.target.result);
                            displayImages();
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>

@endsection
