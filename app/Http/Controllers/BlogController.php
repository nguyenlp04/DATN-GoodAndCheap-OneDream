<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function listing()
    {  $topBlogs = Blog::orderBy('views', 'desc') // Sắp xếp theo số lượt xem giảm dần
        ->take(5) // Lấy 5 bài viết có views cao nhất
        ->get();
        $blogs = Blog::all(); // Lấy tất cả bài viết từ cơ sở dữ liệu
        return view('blocks.blog.listting_blog', compact('blogs','topBlogs')); // Trả về view với danh sách blog
    }

    // Hiển thị form thêm bài viết
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Lưu bài viết mới
  

    // Lưu bài viết mới
    public function store(Request $request)
{
    // Xác thực dữ liệu
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required|string',
        'short_description' => 'min:10|string|max:255', // Kiểm tra mô tả ngắn
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh
    ]);

    // Lấy ID của người dùng đăng nhập hiện tại
    $staffId = Auth::id();

    // Xử lý ảnh
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); 
    }


    Blog::create([
        'title' => $request->title,
        'content' => $request->content,
        'staff_id' => $staffId,
        'image' => $imagePath, 
        'short_description' => $request->short_description, 
    ]);

    return redirect()->route('blogs.index')->with('success', 'Bài viết đã được thêm thành công');
}

public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string|min:6',
        'short_description' => 'required|string|min:10|max:255',
        'status' => 'required|in:0,1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh có thể không bắt buộc
    ]);

    $blog->title = $request->title;
    $blog->content = $request->content;
    $blog->short_description = $request->short_description; // Cập nhật mô tả ngắn
    $blog->status = $request->status;

    // Xử lý ảnh
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        // Lưu ảnh mới
        $imagePath = $request->file('image')->store('images', 'public');
        $blog->image = $imagePath; // Cập nhật đường dẫn ảnh
    }

    $blog->save(); // Lưu thay đổi

    return redirect()->route('blogs.index')->with('success', 'Bài viết đã được cập nhật thành công!');
}

 // Hiển thị form sửa bài viết
 public function edit(Blog $blog)
 {
     return view('admin.blogs.edit', compact('blog'));
 }
    // Xóa bài viết
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được xóa');
    }
    public function toggleStatus($id)
    {
        // Lấy ID người dùng hiện tại
        $userId = Auth::id();
        
        // Tìm bài viết bằng ID
        $blog = Blog::findOrFail($id);
        
        // Chuyển đổi trạng thái (1: Hiện, 0: Ẩn)
        $blog->status = $blog->status == 1 ? 0 : 1;
        $blog->save();
    
        // Trả về phản hồi JSON với trạng thái mới
        return response()->json([
            'status' => $blog->status,
            'message' => 'Trạng thái bài viết đã được cập nhật thành công.',
        ]);
    }
    
public function show($id){
    $blog = Blog::findOrFail($id);
    return view('admin.blogs.detail', compact('blog'));
}
}