@extends('layouts.client_layout')

@section('content')

<style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
        color: #555;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .custom-dropzone {
        border: 2px dashed #ddd;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        background-color: #f9f9f9;
        transition: border-color 0.3s, background-color 0.3s;
    }

    .custom-dropzone:hover {
        border-color: #007bff;
        background-color: #f0f8ff;
    }

    .dz-preview img {
        max-width: 100px;
        border-radius: 5px;
        margin: 5px;
        border: 1px solid #ddd;
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

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-weight: bold;
        color: #333;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }
</style>

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
    <div class="form-container">
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
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name_channel" class="form-label">Channel Name:</label>
                    <input type="text" class="form-control" id="name_channel" name="name_channel" placeholder="Enter channel name" value="{{ old('name_channel') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required>
                </div>
            </div>

            <!-- Address -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="city" class="form-label">City:</label>
                    <select id="city" name="city" class="form-select form-control">
                        <option value="" selected>Select City</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="district" class="form-label">District:</label>
                    <select id="district" name="district" class="form-select form-control">
                        <option value="" selected>Select District</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ward" class="form-label">Ward:</label>
                    <select id="ward" name="wards" class="form-select form-control">
                        <option value="" selected>Select Ward</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="addressDetail" class="form-label">Detailed Address:</label>
                <input type="text" id="addressDetail" name="address" class="form-control" placeholder="Enter detailed address" >
            </div>

            <!-- Upload images -->
            <div class="card mb-4">
                <div class="card-header">Channel Images</div>
                <div class="card-body">
                    <div class="custom-dropzone" id="dropzone">
                        <button type="button" class="btn btn-outline-primary dz-browse-btn">Select Images</button>
                        <input type="file" name="image_channel" multiple accept="image/*" style="display: none;">
                        <div id="image-preview" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-2">Create Channel</button>
                <a href="{{ route('channels.index') }}" class="btn btn-secondary">Cancel</a>
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

@endsection
