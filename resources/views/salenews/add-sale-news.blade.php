@extends('layouts.client_layout')
@section('content')
<main class="main">

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sale News</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                </div><!-- End .checkout-discount -->
                <form action="{{ route('add.sale-news') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- {{ Auth::user()->user_id }} -->
                    <div class="d-flex justify-content-between">
                        <h4 class="">Sale News information</h4><!-- End .checkout-title -->
                        <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish product</button>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <!-- <label>Title</label>
                                                        <input type="text" class="form-control"> -->
                            <label class="font-weight-bold form-label" for="ecommerce-product-name">Title</label>
                            @error('productTitle')
                            <span class="text-danger">
                                <i class="bx bx-error-circle me-2"></i>
                                {{ $message }}
                            </span>
                            @enderror
                            <input type="text" class="form-control" id="ecommerce-product-name"
                                placeholder="Product title" name="productTitle" aria-label="Product title">


                            <label for="description" class="font-weight-bold form-label">Description</label>
                            @error('description')
                            <span class="text-danger">
                                <i class="bx bx-error-circle me-2"></i>
                                {{ $message }}
                            </span>
                            @enderror
                            <textarea class="form-control" name="description" id="editor" rows="3"></textarea>
                            <!-- Media -->
                            <script
                                src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js">
                            </script>
                            <link rel="stylesheet"
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
                            <div class="mt-1">
                                <div class="card-header d-flex align-items-center">
                                    <label for="productImage" class="font-weight-bold form-label">Product Image</label>
                                    @error('images.*')
                                    <span class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
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
                                            <input type="file" id="fileInput" name="images[]" multiple
                                                accept="image/*" style="display: none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Media -->

                            <input type="hidden" id="variant" name="variant" value="">
                            <div class="card-header d-flex justify-content-between align-items-center mt-1">
                                <label for="variants" class="font-weight-bold form-label">Variants</label>
                            </div>
                            <div class="">
                                <div id="add-variant" class="row">
                                </div>
                            </div>
                            <div class=" d-flex align-items-center mt-1">
                                <label class="font-weight-bold">Address</label>
                                @error('addressDetail')
                                <span class="text-danger">
                                    <i class="bx bx-error-circle me-2"></i>
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" id="addressDetail" name="addressDetail" class="form-control" placeholder="Address">
                                </div>
                                <div class="col-6">
                                    <select name="" class="form-control" id="city">
                                        <option selected>Select Province/City</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="" class="form-control" id="district">
                                        <option selected>Select District</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="" class="form-control" id="ward">
                                        <option selected>Select Ward</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="hiddenAddress" name="hiddenAddress">
                            <label class="font-weight-bold form-label" for="ecommerce-product-name">Phone
                                Number</label>
                            @error('phone')
                            <span class="text-danger">
                                <i class="bx bx-error-circle me-2"></i>
                                {{ $message }}
                            </span>
                            @enderror
                            <input type="text" class="form-control" id="ecommerce-product-phone"
                                placeholder="Phone Number" name="phone" aria-label="Product title">

                            <!-- /Second column -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <!-- <div class="summary"> -->
                            <div>
                                <label for="price" class="font-weight-bold">Price</label> @error('price')
                                <span class="text-danger">
                                    <i class="bx bx-error-circle me-2"></i>
                                    {{ $message }}
                                </span>
                                @enderror
                                <input id="price" type="number" class="form-control" placeholder="Price"
                                    name="price">


                                <label for="category" class="font-weight-bold" name="name_category">Category Name</label>
                                @error('name_category')
                                <span class="text-danger">
                                    <i class="bx bx-error-circle me-2"></i>
                                    {{ $message }}
                                </span>
                                @enderror
                                <select id="category" name="name_category" class="form-control form-select">
                                    <option value="">Select Category Name</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->name_category }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="mb-3" id="subcategory-section" style="display: none;">
                                    <label for="subcategory" class="font-weight-bold form-label">SubCategory
                                        Name:</label>
                                    @error('subcategory_id')
                                    <span class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <select id="subcategory" name="subcategory_id" class="form-control form-select">
                                    </select>
                                </div>

                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
                <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
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
                            <div class="col-6 mb-1">
                                <div class="mb-2 variant-card">
                                <div class="card-header">
                                    <input type="text" name="variant[${index}][name]" class="form-control option-input font-weight-bold" value="${category_variant.attributes_name}" readonly>
                                </div>
                                <div class="card-body p-0">
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
@endsection

@section('script-link-css')
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
@endsection
