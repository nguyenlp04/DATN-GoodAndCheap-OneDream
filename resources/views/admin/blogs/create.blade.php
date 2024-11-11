@extends('layouts.admin')
@section('content')

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="app-ecommerce">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Add A New Blog</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4">
                            <button class="btn btn-label-secondary">Discard</button>
                            <button class="btn btn-label-primary">Save draft</button>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish </button>
                    </div>

                </div>

                <div class="row">

                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- Blog Information -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Blog Information</h5>
                            </div>
                            <div class="card-body">
                                <!-- Hiển thị thông báo lỗi -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form thêm Blog -->
                                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Title:</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter blog title">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Short Description:</label>
                                        <input type="text" name="short_description" class="form-control" placeholder="Enter short description">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Content:</label>
                                        <textarea name="content" id="content"  rows="5" class="form-control"  ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Blog Image:</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Blog</button>
                                </form>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

       

@endsection