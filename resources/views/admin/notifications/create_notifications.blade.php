@extends('layouts.admin')
@section('content')

<style>
    /* Ẩn chữ trong input file */
input[type="file"] {
  opacity: 0;
  position: absolute;
  z-index: -1;
}

.custom-file-upload {
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
}

.custom-label {
  padding: 10px 20px;
  background-color: #6ca0d8;
  color: #fff;
  cursor: pointer;
  border-radius: 5px;
}

.custom-label:hover {
  background-color: #0056b3;
}

.file-name {
  font-size: 14px;
  color: #6c757d;
}

.form-label:hover {
  background-color: #0056b3;
}

</style>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="app-ecommerce">

                <!-- Add Product -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Add A New notification</h4>
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
                        <!-- notification Information -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">notification Information</h5>
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

                                <!-- Form thêm notification -->
                                <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Title:</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter notification title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content:</label>
                                        <textarea name="content" class="form-control" placeholder="Enter notification content"></textarea>
                                    </div>

                                    {{-- <div class="mb-3 custom-file-upload">
                                        <label class="form-label">notification Image:</label>
                                        <input type="file" name="image" class="form-control" st>
                                    </div> --}}
                                    <div class="mb-3 custom-file-upload">
                                        <label for="file-upload" class="form-label custom-label">Choose File</label>
                                        <span class="file-name">No file chosen</span>
                                        <input id="file-upload" type="file" name="image" class="form-control" onchange="updateFileName(this)">
                                      </div>
                                      

                                    <button type="submit" class="btn btn-primary">Create notification</button>
                                </form>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
</div>

<script>
    function updateFileName(input) {
  const fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
  document.querySelector(".file-name").textContent = fileName;
}

</script>
@endsection
