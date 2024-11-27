@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-cog me-2"></i> Settings</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" id="formSettings" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="logo" class="form-label w-25"><strong>Logo</strong></label>
                                    <input type="file" class="form-control d-none" id="logoInput" name="logo" accept="image/*" onchange="previewImage(event, 'logoPreview')" />
                                    <img id="logoPreview" src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt="Image logo" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('logoInput').click();" />
                                    @error('logo')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="logo_mobile" class="form-label w-25"><strong>Logo Mobile</strong></label>
                                    <input type="file" class="form-control d-none" id="logo_mobileInput" name="logo_mobile" accept="image/*" onchange="previewImage(event, 'logo_mobilePreview')" />
                                    <img id="logo_mobilePreview" src="{{ $setting->logo_mobile ? asset($setting->logo_mobile) : '' }}" alt="Image logo_mobile" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('logo_mobileInput').click();" />
                                    @error('logo_mobile')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="favicon" class="form-label w-25"><strong>Favicon</strong></label>
                                    <input type="file" class="form-control d-none" id="faviconInput" name="favicon" accept="image/*" onchange="previewImage(event, 'faviconPreview')" />
                                    <img id="faviconPreview" src="{{ $setting->favicon ? asset($setting->favicon) : '' }}" alt="Image favicon" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('faviconInput').click();" />
                                    @error('favicon')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="banner1" class="form-label w-25"><strong>Banner 1</strong></label>
                                    <input type="file" class="form-control d-none" id="banner1Input" name="banner1" accept="image/*" onchange="previewImage(event, 'banner1Preview')" />
                                    <img id="banner1Preview" src="{{ $setting->banner1 ? asset($setting->banner1) : '' }}" alt="Image banner1" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('banner1Input').click();" />
                                    @error('banner1')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="banner2" class="form-label w-25"><strong>Banner 2</strong></label>
                                    <input type="file" class="form-control d-none" id="banner2Input" name="banner2" accept="image/*" onchange="previewImage(event, 'banner2Preview')" />
                                    <img id="banner2Preview" src="{{ $setting->banner2 ? asset($setting->banner2) : '' }}" alt="Image banner2" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('banner2Input').click();" />
                                    @error('banner2')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="banner3" class="form-label w-25"><strong>Banner 3</strong></label>
                                    <input type="file" class="form-control d-none" id="banner3Input" name="banner3" accept="image/*" onchange="previewImage(event, 'banner3Preview')" />
                                    <img id="banner3Preview" src="{{ $setting->banner3 ? asset($setting->banner3) : '' }}" alt="Image banner3" style="margin-top: 10px; max-width: 100px; max-height: 100px; cursor: pointer;" onclick="document.getElementById('banner3Input').click();" />
                                    @error('banner3')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="site_name" class="form-label"><strong>Site Name</strong></label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $setting->site_name ?? '' }}" />
                                    @error('site_name')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="meta_title" class="form-label"><strong>Meta Title</strong></label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $setting->meta_title ?? '' }}" />
                                    @error('meta_title')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="meta_description" class="form-label"><strong>Meta Description</strong></label>
                                    <textarea class="form-control" id="meta_description" name="meta_description">{{ $setting->meta_description ?? '' }}</textarea>
                                    @error('site_name')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $meta_description }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="contact_email" class="form-label"><strong>Contact Email</strong></label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $setting->contact_email ?? '' }}" />
                                    @error('contact_email')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="contact_phone" class="form-label"><strong>Contact Phone</strong></label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $setting->contact_phone ?? '' }}" />
                                    @error('contact_phone')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label"><strong>Address</strong></label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $setting->address ?? '' }}" />
                                    @error('address')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="facebook_link" class="form-label"><strong>Facebook Link</strong></label>
                                    <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="{{ $setting->facebook_link ?? '' }}" />
                                    @error('facebook_link')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="instagram_link" class="form-label"><strong>Instagram Link</strong></label>
                                    <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="{{ $setting->instagram_link ?? '' }}" />
                                    @error('instagram_link')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="twitter_link" class="form-label"><strong>Twitter Link</strong></label>
                                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{ $setting->twitter_link ?? '' }}" />
                                    @error('twitter_link')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="youtube_link" class="form-label"><strong>YouTube Link</strong></label>
                                    <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ $setting->youtube_link ?? '' }}" />
                                    @error('youtube_link')
                                    <div class="text-danger">
                                        <i class="bx bx-error-circle me-2"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
<script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>

<script>
    function previewImage(event, elementId) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(elementId);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection