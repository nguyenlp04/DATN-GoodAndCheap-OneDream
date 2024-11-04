@extends('layouts.admin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">

        <form action="{{ route('addCategory')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="app-ecommerce" data-select2-id="21">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Add A New Category</h4>
                    </div>
                    <!-- Form Add Category -->


                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <!-- <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                            <button class="btn btn-label-primary">Save draft</button>
                        </div> -->
                        <button type="submit" class="btn btn-primary" id="publish-product">Publish product</button>
                    </div>

                </div>

                <div class="row" data-select2-id="20">

                    <!-- First column-->
                    <!-- <div class="col-12 col-lg-12"> -->
                    <!-- Product Information -->
                    <div class="col-12 col-lg-8">
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Product information</h5>
                                <!-- Các nút nằm ngang hàng với tiêu đề -->
                                <div>

                                    <button id="add-subcategory" type="button" class="btn btn-primary ml-2">Add Subcategory</button>
                                    <!-- <button type="submit" class="btn btn-primary">Create Category</button> -->
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="mb-6">
                                    <label for="name_category" class="form-label">Category Name:</label>
                                    <input type="text" name="name_category" class="form-control" id="name_category" required placeholder="Enter category name">
                                </div>
                                <div class="mb-6">
                                    <label for="description_category" class="form-label">Category Description</label>
                                    <textarea class="form-control" id="description_category" name="description" rows="3"></textarea>
                                </div>

                                <!-- Thêm Subcategories -->
                                <div class="mb-6" id="subcategory-section" style="display: none;">
                                    <label for="subcategories" class="form-label">Subcategories:</label>
                                    <div id="subcategory-wrapper">
                                        <div class="input-group mb-2">

                                        </div>
                                    </div>
                                </div>


                                <!-- Script thêm/xóa Subcategory -->
                                <script>
                                    // Khi trang tải, ẩn phần subcategory
                                    document.getElementById('subcategory-section').style.display = 'none';

                                    // Khi nhấn nút Add Subcategory
                                    document.getElementById('add-subcategory').addEventListener('click', function() {
                                        const subcategorySection = document.getElementById('subcategory-section');

                                        // Hiển thị phần subcategory nếu chưa hiển thị
                                        if (subcategorySection.style.display === 'none') {
                                            subcategorySection.style.display = 'block';
                                        }

                                        const wrapper = document.getElementById('subcategory-wrapper');
                                        const div = document.createElement('div');
                                        div.classList.add('input-group', 'mb-2');
                                        div.innerHTML = `
                                <input type="text" name="subcategories[]" class="form-control" placeholder="Enter subcategory">
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-subcategory" type="button">Remove</button>
                                </div>
                                `;
                                        wrapper.appendChild(div);
                                    });

                                    // Xóa subcategory
                                    document.addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-subcategory')) {
                                            e.target.closest('.input-group').remove();
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">

                        <div class="card mb-6" data-select2-id="18">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Upload Imgae</h5>
                            </div>
                            <div class="card-body">
                                <div class="dropzone p-0 dz-clickable" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 11.5rem;">
                                    <!-- @isset($dataStaffID)
                                    @if($dataStaffID->image == null) -->
                                    <img id="preview_img" class=" mt-3 rounded" style="width: 100px; height: auto;">
                                    <!-- @else -->
                                    <img id="preview_img" src="{{ asset($dataStaffID->image) }}" class="mt-3 border rounded" style="width: 100px; height: auto;">
                                    <!-- @endif
                                    @endisset -->
                                    <img id="preview_img" class=" mt-3 rounded" style="width: 100px; height: auto;">
                                    <div style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnBrowse">Browse image</button>
                                        <input type="file" id="fileInput" name="image" style="display: none">
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>

                    </div>



                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Variants</h5>
                            <button type="button" class="btn btn-primary" id="btn-add-variant">
                                <i class="bx bx-plus bx-sm me-2"></i>
                                Add Variant
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="add-variant">
                                <!-- New variants will be inserted here -->
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->


                    <script>
                        document.getElementById('btn-add-variant').addEventListener('click', function() {
                            const variantWrapper = document.getElementById('add-variant');

                            // Create a new div for the variant input fields
                            const div = document.createElement('div');
                            div.classList.add('variant-item', 'mb-3');

                            // Create the HTML for the new variant input fields
                            div.innerHTML = `
                            <div class="input-group mb-2">
                                <input type="text" name="variants[]" class="form-control" placeholder="Enter variant name" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-variant" type="button">Remove</button>
                                </div>
                            </div>
                        `;

                            // Append the new variant input to the variant wrapper
                            variantWrapper.appendChild(div);
                        });

                        // Event delegation to handle removing variant
                        document.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-variant')) {
                                e.target.closest('.variant-item').remove();
                            }
                        });
                        document.getElementById('publish-product').addEventListener('click', function() {
                            // Lấy giá trị của Category Name
                            const categoryName = document.getElementById('name_category').value.trim();

                            // Lấy tất cả các trường Variant
                            const variants = document.getElementsByName('variants[]');

                            // Biến để kiểm tra có lỗi hay không
                            let hasError = false;

                            // Kiểm tra nếu Category Name trống
                            if (categoryName == "") {
                                console.log("Category Name is required.");
                                hasError = true;
                            }

                            // Kiểm tra nếu không có Variant nào
                            if (variants.length == 0) {
                                console.log("At least one variant is required.");
                                hasError = true;
                            }

                            // Nếu không có lỗi thì submit form
                            if (!hasError) {
                                document.querySelector('form').submit();
                            }
                        });
                    </script>

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
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
{{-- no ko buton dc  --}}
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.getElementById('btnBrowse').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
</script>

<script>
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

@if (session('alert'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "{{ session('alert')['type'] }}",
        title: "{{ session('alert')['message'] }}"
    });
</script>
@endif
@endsection