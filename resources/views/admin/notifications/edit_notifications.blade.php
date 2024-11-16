@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


            <div class="app-ecommerce" data-select2-id="21">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edit notification</h4>
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
                        <!-- notification Information -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">notification information</h5>
                                <!-- Các nút nằm ngang hàng với tiêu đề -->
                                <div>

                                    
                               
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Hiển thị thông báo thành công -->
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <!-- For sửa thêm notification -->
                                <form action="{{ route('notifications.update', $notifications->notification_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') 
                                    <div class="mb-6">
                                        <label class="form-label">Title:</label>
                                        <input type="text" name="title" class="form-control mb-3" placeholder="Enter notification title" value="{{ old('title', $notifications->title) }}">
                                        @if ($errors->has('title'))
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                
                                        <label class="form-label">Content:</label>
                                        <textarea name="content" class="form-control mb-3">{{ old('content', $notifications->content) }}</textarea>
                                        @if ($errors->has('content'))
                                            <div class="text-danger">{{ $errors->first('content') }}</div>
                                        @endif
                                
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-select mb-2">
                                            <option value="public" {{ old('status', $notifications->status) == 'public' ? 'selected' : '' }}>Public</option>
                                            <option value="private" {{ old('status', $notifications->status) == 'private' ? 'selected' : '' }}>Private</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
                                
                                        <label for="type">Type:</label>
                                        <select name="type" id="type" class="form-select mb-2">
                                            <option value="website" {{ old('type', $notifications->type) == 'website' ? 'selected' : '' }}>Website</option>
                                            <option value="user" {{ old('type', $notifications->type) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="channel" {{ old('type', $notifications->type) == 'channel' ? 'selected' : '' }}>Channel</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <div class="text-danger">{{ $errors->first('type') }}</div>
                                        @endif
                                
                                        <label class="form-label">Image:</label>
                                        <input type="file" name="image" class="form-control mb-3">
                                        <img src="{{ asset('storage/' . $notifications->image) }}" alt="notification Image" style="width: 70px; height: auto;">
                                        @if ($errors->has('image'))
                                            <div class="text-danger">{{ $errors->first('image') }}</div>
                                        @endif
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Update notification</button>
                                </form>
                                

                              
                            </div>
                        </div>
                        
                        
                        
                    </div>
                  
                    

                </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
</div>
@endsection