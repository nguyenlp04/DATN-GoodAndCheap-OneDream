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
                        <h4 class="mb-1">Add A New Category</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <!-- <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                            <button class="btn btn-label-primary">Save draft</button>
                        </div> -->
                        <button type="submit" class="btn btn-primary" id="publish-product">Publish product</button>
                    </div>

                </div>

                <div class="row" data-select2-id="20">

                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- Product Information -->
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
                                <!-- Hiển thị thông báo thành công -->
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <!-- Form thêm Category -->
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-6">
                                        <label for="category_name" class="form-label">Category Name:</label>
                                        <input type="text" name="category_name" class="form-control" id="category_name" required placeholder="Enter category name">
                                    </div>

                                    <!-- Thêm Subcategories -->
                                    <div class="mb-6" id="subcategory-section" style="display: none;">
                                        <label for="subcategories" class="form-label">Subcategories:</label>
                                        <div id="subcategory-wrapper">
                                            <div class="input-group mb-2">

                                            </div>
                                        </div>
                                    </div>
                                </form>

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
                    </div>


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
                            const categoryName = document.getElementById('category_name').value.trim();
                            
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
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    
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