<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Category;
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
    $topBlogs = Blog::where('status', 1) // Lọc bài viết có status = 1
        ->orderBy('views', 'desc')       // Sắp xếp theo số lượt xem giảm dần
        ->take(5)                         // Lấy 5 bài viết có views cao nhất
        ->get();

    $blogs = Blog::where('status', 1)    // Lọc tất cả bài viết có status = 1
        ->get();

    return view('blocks.blog.listting_blog', compact('blogs', 'topBlogs')); // Trả về view với danh sách blog
}


    // Hiển thị form thêm bài viết
    public function create()
    {
        $categories=Category::all();
        return view('admin.blogs.create',['categories'=>$categories]);
    }

    // Lưu bài viết mới
  

    // Lưu bài viết mới
    public function store(Request $request)
    {
      
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,category_id', // Kiểm tra nếu category_id tồn tại trong bảng categories
            'short_description' => 'min:10|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
        $staffId = Auth::id();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); 
        }
        
        // Chỉ truyền một category_id duy nhất nếu là single select
        $categoryId = $request->category_id;
        dd($request->category_id);
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'staff_id' => $staffId,
            'image' => $imagePath,
            'category_id' => $categoryId, // Truyền giá trị category_id vào
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
public function detail($id){
    $blogs = Blog::findOrFail($id);
   
    $topBlogs = Blog::where('status', 1) // Lọc bài viết có status = 1
        ->orderBy('views', 'desc')       // Sắp xếp theo số lượt xem giảm dần
        ->take(5)                         // Lấy 5 bài viết có views cao nhất
        ->get();

  
    return view('blocks.blog.detail-blog', compact('blogs','topBlogs'));
}
}