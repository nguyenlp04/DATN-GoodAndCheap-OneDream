@extends('layouts.admin')
@section('content')

        <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


            <div class="app-ecommerce" data-select2-id="21">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edit blog</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                            <button class="btn btn-label-primary">Save draft</button>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish </button>
                    </div>

                </div>

                <div class="row" data-select2-id="20">

                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- Blog Information -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Blog information</h5>
                                <!-- Các nút nằm ngang hàng với tiêu đề -->
                                <div>

                                    
                               
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Hiển thị thông báo thành công -->
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <!-- For sửa thêm Blog -->
                                <form action="{{ route('blogs.update', $blog->blog_id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT') 
                                    <div class="mb-6">
                                    <label class="form-label">Title:</label>
                                    <input type="text" name="title" class="form-control mb-3" placeholder="Enter blog title" value="{{ $blog->title }}">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                    <label class="form-label">Short Description:</label>
                                    <input type="text" name="short_description" class="form-control mb-3" placeholder="Enter short description" value="{{ $blog->short_description }}">
                                    @if ($errors->has('short_description'))
                                        <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                    @endif
                                    <label class="form-label">Content:</label>

                                    <textarea name="content" id="content"  rows="5" class="form-control mb-3"  >{!!$blog->content !!}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                    <label for="status">Status:</label>

                                    <select name="status" id="status" class="form-select mb-2" >
                                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Show</option>
                                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Hiden</option>
                                    </select>
                                   

                                    <label class="form-label">Image:</label>
                                    <input type="file" name="image" class="form-control mb-3">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 70px; height: auto;">
                                    @if ($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @endif

                                        </div>
                                       <button type="submit" class="btn btn-primary">Update blog</button>
                                </form>

                              
                            </div>
                        </div>
                        
                        
                        
                    </div>
                  
                    

                </div>
            </div>
        </div>
       
@endsection