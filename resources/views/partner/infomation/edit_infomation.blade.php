@extends('layouts.partner_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
        <!-- Edit Information Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1">Edit Information</h4>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-4">
                <div class="d-flex gap-4">
                    <button class="btn btn-label-secondary" onclick="window.history.back()">Cancel</button>
                </div>
                <button type="submit" form="edit-information-form" class="btn btn-primary" id="btn-update-product">Update</button>
            </div>
        </div>

        <div class="row">
            <!-- Information Details Section -->
            <div class="col-12 col-lg-12">
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Information Details</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Information Form -->
                        <form id="edit-information-form" action="{{ route('partners.update.infomation', $info->channel_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="about" class="form-label">About Us:</label>
                                <textarea name="about" id="editor" class="form-control" placeholder="Enter about description" style="height: 300px;">{{ $info->about }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="banner_url" class="form-label">Banner Image:</label>
                                <div class="dropzone p-0 dz-clickable" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 11.5rem;">
                                    <img id="preview_img" class="mt-3 rounded" src="{{ asset('storage/' . $info->banner_url) }}" style="width: 100px; height: auto;" alt="Current Banner">
                                    <div style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnBrowse">Browse Image</button>
                                        <input type="file" id="fileInput" name="banner_url" style="display: none">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script-link-css')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">

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
