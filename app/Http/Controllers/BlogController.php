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
        $blogs = Blog::paginate(10); // Sử dụng phân trang
        return view('admin.blogs.index', compact('blogs'));
    }
    public function create()
    {
        return view('admin.blogs.create');
    }

    public function listting()
    {

        $topBlogs = Blog::orderBy('views', 'desc') // Sắp xếp theo số lượt xem giảm dần
            ->take(5) // Lấy 5 bài viết có views cao nhất
            ->get();
        $alltags = Blog::all();
        $blogs = Blog::all(); // Lấy tất cả bài viết từ cơ sở dữ liệu
        $count = Blog::where('status', '1')->count();
        return view('blog.listting', compact('blogs', 'topBlogs', 'alltags', 'count')); // Trả về view với danh sách blog

    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        try {
            // Xác thực dữ liệu
            $validatedData = $request->validate([
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
                $imagePath = $request->file('image')->store('images', 'public'); // Lưu ảnh vào thư mục 'images' trong 'public'
            }
            $tags = $request->input('tags', []); // Tags mặc định là mảng rỗng nếu không có

            // Tạo bản ghi mới trong bảng blogs
            Blog::create([
                'title' => $validatedData['title'],
                'tags' => $tags,
                'content' => $validatedData['content'],
                'staff_id' => $staffId, // Lưu ID của người dùng đăng nhập
                'image' => $imagePath, // Lưu đường dẫn ảnh
                'short_description' => $validatedData['short_description'],
            ]);

            // Chuyển hướng về trang danh sách blog với thông báo thành công
            return redirect()->route('blogs.index')->with('alert', [
                'type' => 'success',
                'message' => 'Blog created successfully!'
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ và trả về thông báo lỗi
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
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
            'short_description' => 'required|string|min:10|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh có thể không bắt buộc
        ]);

        try {
            // Cập nhật thông tin bài viết
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->tags = $request->tags;
            $blog->short_description = $request->short_description; // Cập nhật mô tả ngắn
            $blog->status = $request->status;

            // Xử lý ảnh
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu có
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }
                // Lưu ảnh mới
                $imagePath = $request->file('image')->store('images', 'public');
                $blog->image = $imagePath; // Cập nhật đường dẫn ảnh
            }

            // Lưu thay đổi vào cơ sở dữ liệu
            $blog->save();

            // Trả về thông báo thành công
            return redirect()->route('blogs.index')->with('alert', [
                'type' => 'success',
                'message' => 'Blog updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có lỗi xảy ra
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // Xóa bài viết
    public function destroy(Blog $blog)
    {
        try {
            // Xóa bài viết
            $blog->delete();

            // Trả về thông báo thành công
            return redirect()->route('blogs.index')->with('alert', [
                'type' => 'success',
                'message' => 'Blog deleted successfully!'
            ]);
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có lỗi xảy ra
            return redirect()->route('blogs.index')->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // Chuyển đổi trạng thái (Ẩn/Hiển thị)
    public function toggleStatus($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->status = $blog->status == 1 ? 0 : 1;
            $blog->save();

            $statusMessage = $blog->status == 1 ? 'Hiển thị' : 'Ẩn';

            return response()->json([
                'status' => $blog->status,
                'message' => "Blog status updated to {$statusMessage}"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.detail', compact('blog'));
    }
    public function detail($id)
    {
        $blogs = Blog::findOrFail($id);
        $alltags = Blog::all();
        $topBlogs = Blog::where('status', 1) // Lọc bài viết có status = 1
            ->orderBy('views', 'desc')       // Sắp xếp theo số lượt xem giảm dần
            ->take(5)                         // Lấy 5 bài viết có views cao nhất
            ->get();


        return view('blocks.blog.detail-blog', compact('blogs', 'topBlogs', 'alltags'));
    }
}
