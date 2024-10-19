<div class="container">
    <h1>{{ $blog->title }}</h1> <!-- Hiển thị tiêu đề bài viết -->
    
    <p><strong>Nội dung:</strong></p>
    <p>{{ $blog->content }}</p> <!-- Hiển thị nội dung bài viết -->

    <p><strong>Trạng thái:</strong> {{ $blog->status == 1 ? 'Hiện' : 'Ẩn' }}</p> <!-- Hiển thị trạng thái -->

    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Quay lại danh sách</a> <!-- Nút quay lại danh sách -->
</div>