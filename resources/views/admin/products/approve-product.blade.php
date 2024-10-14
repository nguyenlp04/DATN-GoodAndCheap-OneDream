@extends('layouts.admin')
@section('content')
 <!-- Layout container -->
 <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
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
                    aria-label="Search..."
                  />
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
                      <h4 class="mb-1">Add a new Product</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                      <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                        <button class="btn btn-label-primary">Save draft</button></div>
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
                            <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Product title" name="productTitle" aria-label="Product title">
                          </div>
                          <!-- Description -->
                          <div>
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                      <!-- /Product Information -->
                      <!-- Media -->
                      <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js"></script>
                      <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
                      <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <h5 class="mb-0 card-title">Product Image</h5>
                        </div>
                        <div class="card-body">
                          <form action="/upload" class="dropzone needsclick p-0 dz-clickable" id="dropzone-basic">
                            <div class="dz-message needsclick">
                              <p class="h4 needsclick pt-4 mb-2">Drag and drop your image here</p>
                              <p class="h6 text-muted d-block fw-normal mb-2">or</p>
                              <button type="button" class="btn btn-sm btn-outline-primary" id="btnBrowse">Browse image</button>
                            </div>
                            
                          </form>
                        </div>
                      </div>
                      <!-- /Media -->
                      <!-- Variants -->
                      <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Variants</h5>
                            <button type="button" class="btn btn-primary" id="btn-add-variant">
                                <i class="bx bx-plus bx-sm me-2"></i>
                                Add Variant
                            </button>
                        </div>
                    </div>
                    
                    <div id="add-variant">
                        <!-- New variants will be inserted here -->
                    </div>
                  
                     <!-- Variants List -->
                     <div class="card mb-6">
                        <div class="card-header">
                          <h5 class="card-tile mb-0">Variants List</h5>
                        </div>
                        <div class="card-body">
                            <table id="variant-list-table" class="table table-bordered">
                                <thead>
                                    <tr id="variant-list-header">
                                        <!-- Variant headers will be dynamically added here -->
                                    </tr>
                                </thead>
                                <tbody id="variant-list-body">
                                    <!-- Variant combinations will be added here -->
                                </tbody>
                            </table>
                         
                        </div>
                      </div>
                      <!-- /Variants List -->
                    <script>
                     let variants = [];

                    // Add variant button event listener
                    document.getElementById('btn-add-variant').addEventListener('click', function () {
                        createVariantCard();
                    });

                    // Function to create a new variant card
                    function createVariantCard(variantData = { variant: '', options: [''] }) {
                        const variantHTML = `
                            <div class="card mb-6 variant-card">
                                <div class="card-header">
                                    <span class="card-title mb-0">Name Variant</span>
                                    <div class="col-12">
                                        <input type="text" class="form-control option-input" placeholder="Select Or Enter A Variation" value="${variantData.variant}">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="mb-0">Option</span>
                                    <div class="options-container">
                                        ${variantData.options.map(option => `
                                            <div class="col-12 mt-2">
                                                <input type="text" class="form-control option-value" placeholder="Enter an Option" value="${option}">
                                            </div>
                                        `).join('')}
                                    </div>
                                    <div class="col-12 mt-3 text-end">
                                        <button type="button" class="btn btn-primary btn-done" disabled>Done</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('add-variant').insertAdjacentHTML('beforeend', variantHTML);
                        addBlurEventToOptionInputs();
                        addDoneButtonEventListener();
                        validateVariantInputs();
                    }

                    // Function to add blur event listeners to option inputs
                    function addBlurEventToOptionInputs() {
                        const optionInputs = document.querySelectorAll('.option-value');
                        optionInputs[optionInputs.length - 1].addEventListener('blur', function () {
                            if (this.value.trim() !== '' && !this.nextElementSibling?.classList?.contains('option-value')) {
                                const newInputHTML = `
                                    <div class="col-12 mt-2">
                                        <input type="text" class="form-control option-value" placeholder="Enter an Option">
                                    </div>
                                `;
                                this.parentElement.insertAdjacentHTML('afterend', newInputHTML);
                                addBlurEventToOptionInputs();
                            }
                            validateVariantInputs();
                        });
                    }

                    // Function to validate variant inputs and control "Done" button state
                    function validateVariantInputs() {
                        const variantCards = document.querySelectorAll('.variant-card');
                        variantCards.forEach(function (card) {
                            const nameVariantInput = card.querySelector('.option-input');
                            const optionInputs = card.querySelectorAll('.option-value');
                            const doneButton = card.querySelector('.btn-done');

                            const isNameVariantValid = nameVariantInput.value.trim() !== '';
                            const isAtLeastOneOptionValid = Array.from(optionInputs).some(input => input.value.trim() !== '');

                            doneButton.disabled = !(isNameVariantValid && isAtLeastOneOptionValid);
                        });
                    }

                    // Function to add event listeners to "Done" buttons
                    function addDoneButtonEventListener() {
                        const doneButtons = document.querySelectorAll('.btn-done');
                        doneButtons[doneButtons.length - 1].addEventListener('click', function () {
                            const variantCard = this.closest('.variant-card');
                            const nameVariantInput = variantCard.querySelector('.option-input');
                            const optionInputs = variantCard.querySelectorAll('.option-value');

                            if (this.textContent === 'Done') {
                                // Remove the last empty input if it exists
                                if (optionInputs.length > 0 && optionInputs[optionInputs.length - 1].value.trim() === '') {
                                    optionInputs[optionInputs.length - 1].parentElement.remove();
                                }

                                // Save the variant to the variants list
                                const variantName = nameVariantInput.value.trim();
                                const options = Array.from(optionInputs).map(input => input.value.trim()).filter(val => val !== '');

                                // Update the variants array (check if variant already exists)
                                const existingVariantIndex = variants.findIndex(v => v.variantName === variantName);
                                if (existingVariantIndex !== -1) {
                                    // Update the existing variant
                                    variants[existingVariantIndex].options = options;
                                } else {
                                    // Add a new variant
                                    if (variantName && options.length > 0) {
                                        variants.push({ variantName: variantName, options: options });
                                    }
                                }

                                // Generate the combinations table
                                generateVariantCombinationsTable();

                                // Disable input fields after done
                                optionInputs.forEach(input => input.disabled = true);
                                nameVariantInput.disabled = true;
                                this.textContent = 'Edit';

                            } else {
                                // Enable input fields for editing
                                optionInputs.forEach(input => input.disabled = false);
                                nameVariantInput.disabled = false;

                                // Add a new empty input option automatically when editing
                                const newInputHTML = `
                                    <div class="col-12 mt-2">
                                        <input type="text" class="form-control option-value" placeholder="Enter an Option">
                                    </div>
                                `;
                                variantCard.querySelector('.options-container').insertAdjacentHTML('beforeend', newInputHTML);
                                addBlurEventToOptionInputs();

                                this.textContent = 'Done';
                            }
                        });
                    }

                    // Function to generate the variant combinations table
                    function generateVariantCombinationsTable() {
                        const headers = document.getElementById('variant-list-header');
                        const body = document.getElementById('variant-list-body');

                        // Clear previous headers and rows
                        headers.innerHTML = '';
                        body.innerHTML = '';
                        console.log(variants);
                        
                        // Create table headers
                        variants.forEach(variant => {
                            const th = document.createElement('th');
                            th.textContent = variant.variantName;
                            headers.appendChild(th);
                        });

                        headers.innerHTML += '<th>Quantity</th><th>Price</th>';

                        // Generate combinations
                        const combinations = generateCombinations(variants.map(v => v.options));
                        console.log("combinations: ", combinations);

                        // Create table rows for each combination
                        combinations.forEach(combination => {
                            const row = document.createElement('tr');
                            combination.forEach(value => {
                                const td = document.createElement('td');
                                td.textContent = value;
                                row.appendChild(td);
                            });

                            // Add quantity and price fields
                            row.innerHTML += `
                                <td><input type="number" class="form-control" placeholder="Quantity"></td>
                                <td><input type="number" class="form-control" placeholder="Price"></td>
                            `;
                            body.appendChild(row);
                        });
                    }

                    // Helper function to generate all combinations of options
                    function generateCombinations(arrays) {
                        return arrays.reduce((acc, curr) => {
                            const result = [];
                            acc.forEach(a => {
                                curr.forEach(c => {
                                    result.push([...a, c]);
                                });
                            });
                            return result;
                        }, [[]]);
                    }

                    </script>
                      <!-- /Variants -->
                     
                    
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
                          <!-- Vendor -->
                          <div class="mb-6 col ecommerce-select2-dropdown" data-select2-id="35">
                            <label class="form-label mb-1" for="vendor">
                                Category
                            </label>
                            <div class="position-relative" data-select2-id="34"><select id="vendor" class="select2 form-select select2-hidden-accessible" data-placeholder="Select Vendor" data-select2-id="vendor" tabindex="-1" aria-hidden="true">
                              <option value="men-clothing" data-select2-id="36">Men's Clothing</option>
                              <option value="women-clothing" data-select2-id="37">Women's-clothing</option>
                              <option value="kid-clothing" data-select2-id="38">Kid's-clothing</option>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="5" style="width: 310.664px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-vendor-container"><span class="select2-selection__rendered" id="select2-vendor-container" role="textbox" aria-readonly="true" title=""></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                          </div>
                          <!-- Collection -->
                          <div class="mb-6 col ecommerce-select2-dropdown" data-select2-id="41">
                            <label class="form-label mb-1" for="collection">Subcategory
                            </label>
                            <div class="position-relative" data-select2-id="40"><select id="collection" class="select2 form-select select2-hidden-accessible" data-placeholder="Collection" data-select2-id="collection" tabindex="-1" aria-hidden="true">
                              <option value="men-clothing" data-select2-id="42">Men's Clothing</option>
                              <option value="women-clothing" data-select2-id="43">Women's-clothing</option>
                              <option value="kid-clothing" data-select2-id="44">Kid's-clothing</option>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="9" style="width: 310.664px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-collection-container"><span class="select2-selection__rendered" id="select2-collection-container" role="textbox" aria-readonly="true" title=""></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                          </div>
                          <!-- Status -->
                          <div class="mb-6 col ecommerce-select2-dropdown" data-select2-id="47">
                            <label class="form-label mb-1" for="status-org">Status
                            </label>
                            <div class="position-relative" data-select2-id="46"><select id="status-org" class="select2 form-select select2-hidden-accessible" data-placeholder="Published" data-select2-id="status-org" tabindex="-1" aria-hidden="true">
                              <option value="Published" data-select2-id="48">Published</option>
                              <option value="Scheduled" data-select2-id="49">Scheduled</option>
                              <option value="Inactive" data-select2-id="50">Inactive</option>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="11" style="width: 310.664px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-org-container"><span class="select2-selection__rendered" id="select2-status-org-container" role="textbox" aria-readonly="true" title=""></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                          </div>
                          <!-- Tags -->
                        </div>
                      </div>
                      <!-- /Organize Card -->
                    </div>
                    <!-- /Second column -->
                  </div>
                </div>
                          </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                </script>
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