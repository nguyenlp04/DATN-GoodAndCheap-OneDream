@extends('layouts.admin')
@section('content')
<!-- Layout container -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="app-ecommerce">
                <!-- Blog Details Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Blog Details</h4>
                    </div>
                </div>

                <!-- Blog Information -->
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-6">
                            <div class="card-body">
                                <!-- Hiển thị thông tin chi tiết -->
                                <div class="mb-6">
                                    <label class="form-label">Title:</label>
                                    <p>{{ $blog->title }}</p>

                                    <label class="form-label">Content:</label>
                                    <p>{{ $blog->content }}</p>
                                     <textarea name="noidung" id="noidung"  rows="5" class="form-control" ></textarea>

                                    <label class="form-label">Status:</label>
                                    <p>
                                        <span class="{{ $blog->status == 1 ? 'text-primary' : 'text-secondary' }}">
                                            {{ $blog->status == 1 ? 'Show' : 'Hidden' }}
                                        </span>
                                    </p>

                                </div>
                                <a href="{{ route('blogs.index') }}" class="btn btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
@endsection