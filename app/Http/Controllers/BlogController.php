<?php
namespace App\Http\Controllers;
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
    {
        $blogs = Blog::all(); // Lấy tất cả bài viết từ cơ sở dữ liệu
        return view('blocks.blog.listting_blog', compact('blogs')); // Trả về view với danh sách blog
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
        $request->validate([
            'title' => 'required|max:255',
           'content' => 'required|string|min:6',
        ]);
    
        // Lấy ID của người dùng đăng nhập hiện tại
        $staffId = Auth::id();
    
        // Tạo mới bài viết với staff_id
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'staff_id' => $staffId,
           
        ]);
    
        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được thêm thành công');
    }
    
    // Hiển thị form sửa bài viết
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Cập nhật bài viết
    public function update(Request $request, Blog $blog)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
           'content' => 'required|string|min:6',
            'status' => 'required|in:0,1', // Xác thực giá trị trạng thái
        ]);
    
        // Cập nhật thông tin bài viết
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->status = $request->status; // Cập nhật trạng thái
        $blog->save(); // Lưu thay đổi vào cơ sở dữ liệu
    
        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('blogs.index')->with('success', 'Bài viết đã được cập nhật thành công!');
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