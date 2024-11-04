<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload Your Image</h2>
        
        <!-- Display success or error message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} <br>
                Image Path: {{ session('path') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form for image upload -->
        <form action="{{ route('test') }}" method="GET" enctype="multipart/form-data">
            @csrf <!-- CSRF token for security -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose Image:</label>
                <input class="form-control" type="file" id="formFile" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
