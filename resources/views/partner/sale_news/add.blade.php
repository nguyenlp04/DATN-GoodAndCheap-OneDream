@extends('layouts.partner_layout')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">
            <div class="app-ecommerce" data-select2-id="21">
                {{-- {{ dd($channels->address); }} --}}
                <form action="{{ route('partners.add.storeSaleNewsPartner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Product -->
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1">Add A New Product</h4>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-4">
                            <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                                <button class="btn btn-label-primary">Save draft</button>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish product</button>
                        </div>
                    </div>
                    <div class="row" data-select2-id="20">
                        <!-- First column-->
                        <div class="col-12 col-lg-8">
                            <!-- Product Information -->
                            <div class="card mb-6">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Product information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-6">
                                        <label class="form-label" for="ecommerce-product-name">Name</label>
                                        <input type="text" class="form-control" id="ecommerce-product-name"
                                            placeholder="Product title" name="productTitle" aria-label="Product title">
                                        @error('productTitle')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Price -->

                                    <!-- Description -->
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                        @error('description')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Information -->
                            <!-- Media -->
                            <script
                                src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js">
                            </script>
                            <link rel="stylesheet"
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
                            <div class="card mb-6">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 card-title">Product Image</h5>
                                </div>
                                <div class="card-body">
                                    <div class="dropzone p-0 dz-clickable"
                                        style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 11.5rem;">
                                        <div id="preview_images"
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                                            <!-- Các hình ảnh đã tải lên sẽ được thêm vào đây -->
                                        </div>
                                        <div style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                id="btnBrowse">Browse image</button>
                                            <input type="file" id="fileInput" name="images[]" multiple accept="image/*"
                                                style="display: none">
                                        </div>
                                        @error('images[]')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /Media -->
                            <!-- Variants -->
                            <div class="card mb-6">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Variants</h5>
                                </div>
                                <div class="card-body">
                                    <div id="add-variant" class="row">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Second column -->
                        <!-- Second column -->
                        <div class="col-12 col-lg-4" data-select2-id="19">
                            <!-- Organize Card -->
                            <div class="card mb-6" data-select2-id="18">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Organize</h5>
                                </div>
                                <div class="card-body" data-select2-id="17">
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-price">Price</label>
                                        <input type="number" class="form-control" id="ecommerce-product-price"
                                            placeholder="Price" name="price" aria-label="Product price">
                                        @error('price')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category Name:</label>
                                        <select id="category" name="category_id" class="form-select">
                                            <option value="">Select Category Name</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="subcategory-section" style="display: none;">
                                        <label for="subcategory" class="form-label">SubCategory Name:</label>
                                        @error('subcategory_id')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <select id="subcategory" name="subcategory_id" class="form-select">
                                        </select>
                                    </div>
                                    <input type="hidden" id="variant" name="variant" value="">
                                    <!-- Status -->
                                    <div class="mb-6 col ecommerce-select2-dropdown" data-select2-id="47">
                                        <label class="form-label mb-1" for="status-org">Status
                                        </label>
                                        <div class="position-relative" data-select2-id="46"><select name="status"
                                                id="status-org" class="select2 form-select select2-hidden-accessible"
                                                data-placeholder="Published" data-select2-id="status-org" tabindex="-1"
                                                aria-hidden="true">
                                                <option value="1" name="1" data-select2-id="48">Active
                                                </option>
                                                <option value="2" name="2" data-select2-id="49">Inactive
                                                </option>
                                            </select><span
                                                class="select2 select2-container select2-container--default select2-container--below"
                                                dir="ltr" data-select2-id="11" style="width: 310.664px;"><span
                                                    class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-disabled="false"
                                                        aria-labelledby="select2-status-org-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-status-org-container" role="textbox"
                                                            aria-readonly="true" title=""></span><span
                                                            class="select2-selection__arrow" role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-phone">Phone Number</label>
                                        <input type="number" class="form-control" id="ecommerce-product-phone"
                                            placeholder="phone" name="phone" aria-label="Product phone">
                                        @error('phone')
                                            <div class="text-danger">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <label class="">
                                            <input type="checkbox" id="useOldAddress" name="use_channel_address"
                                                onchange="toggleAddressInput()">
                                            Use Channel Address
                                            @error('hiddenAddress')
                                                <div class="text-danger">
                                                    <i class="bx bx-error-circle me-2"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div id="showAddresChannel" class="mt-3"> {{ $channels->address }}</div>
                                        </label>
                                        <div id="addressInputs" class="">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="addressDetail">Address</label>
                                                    <input type="text" id="addressDetail" class="form-control"
                                                        placeholder="Address">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="city">Province/City</label>
                                                    <select class="form-select" name="" id="city">
                                                        <option selected>Select Province/City</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="district">District</label>
                                                    <select class="form-select" name="" id="district">
                                                        <option selected>Select District</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="ward">Ward</label>
                                                    <select class="form-select" name="" id="ward">
                                                        <option selected>Select Ward</option>
                                                    </select>
                                                </div>
                                                <div id="result"></div>
                                            </div>
                                            <input type="hidden" id="hiddenAddress" name="hiddenAddress">
                                            <input type="hidden" id="hiddenAddressChannel" name="hiddenAddressChannel"
                                                value="{{ $channels->address }}">
                                            <input type="hidden" id="idChannel" name="idChannel"
                                                value="{{ $channels->channel_id }}">

                                        </div>
                                    </div>

                                    <!-- Tags -->
                                </div>
                            </div>
                            <!-- /Organize Card -->
                        </div>
                    </div>
                </form>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Handle change event for category dropdown
                        $('#category').change(function() {
                            var categoryId = $(this).val();
                            $('#add-variant').empty();

                            if (categoryId) {
                                $.ajax({
                                    url: '/get-subcategories/' + categoryId,
                                    type: 'GET',
                                    success: function(data) {
                                        // Empty the subcategory dropdown
                                        $('#subcategory').empty().append(
                                            '<option value="">Select SubCategory Name</option>');

                                        // Populate subcategory dropdown
                                        $.each(data.subcategories, function(index, subcategory) {
                                            $('#subcategory').append('<option value="' + subcategory
                                                .sub_category_id + '">' + subcategory
                                                .name_sub_category + '</option>');
                                        });

                                        // Show subcategory section
                                        $('#subcategory-section').show();

                                        // Add variants dynamically based on subcategory attributes
                                        $.each(data.subcategory_attributes, function(index,
                                            category_variant) {
                                            $('#add-variant').append(`
                                                <div class="col-6">
                                                    <div class="card mb-6 variant-card">
                                                    <div class="card-header">
                                                        <input type="text" name="variant[${index}][name]" class="form-control option-input fw-bold" value="${category_variant.attributes_name}" readonly>
                                                    </div>
                                                    <div class="card-body">
                                                        <div>
                                                        <input type="text" name="variant[${index}][option]" class="form-control option-value" placeholder="Enter an Option">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                `);
                                        });

                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error fetching subcategories:", error);
                                    }
                                });
                            } else {
                                $('#subcategory').empty().append('<option value="">Select SubCategory Name</option>');
                                $('#subcategory-section').hide();
                                $('#add-variant').empty();
                            }
                        });
                        // Handle price and quantity input blur event
                        $(document).on('blur', '.option-value', function() {
                            var variants = [];
                            var variantNames = [];

                            // Collect all variant data
                            $('.variant-card').each(function() {
                                var variantName = $(this).find('.option-input').val();
                                var optionValue = $(this).find('.option-value').val();
                                if (optionValue) {
                                    // Split the options by comma and trim any extra spaces
                                    var options = optionValue.split(',').map(function(value) {
                                        return value.trim();
                                    });
                                    // Construct the variant object
                                    variants.push({
                                        "name": variantName,
                                        "options": options
                                    });
                                }
                            });
                            if (variants.length > 0) {
                                var optionsForCombining = variants.map(variant => variant.options);
                                var variantNames = variants.map(variant => variant.name);

                                //   renderVariantTable(variantNames, result);
                                $('#variant-table-section').show();
                            } else {
                                $('#variant-table-section').hide();
                            }
                            console.log("Variants: ", JSON.stringify(variants, null, 2));
                            $('#variant').val(JSON.stringify(variants));
                            // If there's more than one option, also proceed with storing the result
                            if (variants.length > 1 || variants[0].options.length > 1) {
                                var result = variants.map(variant => ({
                                    "name": variant.name,
                                    "options": variant.options
                                }));
                                $('#variant-table-section').show();
                                $('#variant').val(JSON.stringify(variants)); // Store the variants in the hidden input
                            }
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
                <script>
                    const host = "https://provinces.open-api.vn/api/";
                    var callAPI = (api) => {
                        return axios.get(api)
                            .then((response) => {
                                renderData(response.data, "city");
                            });
                    }
                    callAPI('https://provinces.open-api.vn/api/?depth=1');
                    var callApiDistrict = (api) => {
                        return axios.get(api)
                            .then((response) => {
                                renderData(response.data.districts, "district");
                            });
                    }
                    var callApiWard = (api) => {
                        return axios.get(api)
                            .then((response) => {
                                renderData(response.data.wards, "ward");
                            });
                    }

                    var renderData = (array, select) => {
                        let row = ' <option disable value="">Chọn</option>';
                        array.forEach(element => {
                            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
                        });
                        document.querySelector("#" + select).innerHTML = row
                    }

                    $("#addressDetail").change(() => {
                        // Get the value entered in the #addressDetail input
                        var addressDetailValue = $("#addressDetail").val();

                        // Log the value to the console
                        console.log("Address Detail:", addressDetailValue);

                        // Call the printResult function to update other results (if needed)
                        printResult();
                    });

                    $("#city").change(() => {
                        callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
                        printResult();
                    });
                    $("#district").change(() => {
                        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
                        printResult();
                    });
                    $("#ward").change(() => {
                        printResult();
                    })

                    var printResult = () => {
                        var addressDetailValue = $("#addressDetail").val();
                        if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
                            $("#ward").find(':selected').data('id') != "") {
                            let result = addressDetailValue + ", " + $("#city option:selected").text() +
                                ", " + $("#district option:selected").text() + ", " +
                                $("#ward option:selected").text();
                            $("#hiddenAddress").val(result);
                            $("#result").text(result);
                            console.log("Full address: ", result);
                        }
                    };
                </script>
                <script>
                    function toggleAddressInput() {
                        const checkbox = document.getElementById('useOldAddress');
                        const addressInputs = document.getElementById('addressInputs');
                        const showAddresChannel = document.getElementById('showAddresChannel');


                        if (checkbox.checked) {
                            // Ẩn input nhập địa chỉ mới
                            addressInputs.style.display = 'none';
                            showAddresChannel.style.display = 'block';
                        } else {
                            // Hiện input nhập địa chỉ mới
                            addressInputs.style.display = 'block';
                            showAddresChannel.style.display = 'none';
                        }
                    }

                    // Ẩn input nhập địa chỉ mới mặc định nếu checkbox đã tick
                    document.addEventListener('DOMContentLoaded', function() {
                        toggleAddressInput();
                    });
                </script>
            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
@endsection
