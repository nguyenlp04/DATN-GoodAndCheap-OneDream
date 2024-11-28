<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\SaleNews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
     public function addToWishlist(Request $request)
{
    $user = Auth::user();

    try {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            if ($request->ajax()) {
                return response()->json(['type' => 'error', 'message' => 'Bạn phải đăng nhập để thêm vào danh sách yêu thích.'], 401); // Trả về lỗi nếu là yêu cầu AJAX
            }
            return redirect()->route('login')->with('alert', ['type' => 'error', 'message' => 'Bạn phải đăng nhập để thêm vào danh sách yêu thích.']);
        }

        // Validate dữ liệu
        $request->validate([
            'sale_new_id' => 'required|integer|exists:sale_news,sale_new_id',
        ]);

        // Kiểm tra xem mục này đã có trong danh sách yêu thích chưa
        $existingLike = Like::where('user_id', $user->user_id)
                            ->where('sale_new_id', $request->sale_new_id)
                            ->first();

        if ($existingLike) {
            if ($request->ajax()) {
                return response()->json(['type' => 'error', 'message' => 'This item is already in your favorites list!'], 400); // Trả về lỗi nếu là yêu cầu AJAX
            }
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'This item is already in your favorites list!']);
        }

        // Nếu chưa tồn tại, thêm vào danh sách yêu thích
        Like::create([
            'user_id' => $user->user_id,
            'sale_new_id' => $request->sale_new_id,
            'status' => 1,
        ]);

        if ($request->ajax()) {
            return response()->json(['type' => 'success', 'message' => 'Added to favorites list.']); // Trả về thông báo thành công cho AJAX
        }

        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Added to favorites list.']);

    } catch (\Exception $e) {
        // Nếu có lỗi, trả về thông báo lỗi
        if ($request->ajax()) {
            return response()->json(['type' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }

        return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()]);
    }
}
    public function index()
    {
        $userId = Auth::id();

        // Lấy các sản phẩm từ bảng wishlist của người dùng
        $wishlist = Like::where('user_id', $userId)->with('saleNews.images')->get();

        // Lấy chi tiết các sản phẩm đã yêu thích
        $salenews = SaleNews::with('images')  // Đảm bảo bao gồm mối quan hệ 'images'
            ->whereIn('sale_new_id', $wishlist->pluck('sale_new_id'))  // Lấy các sale_new_id từ wishlist
            ->get();  // Lấy tất cả các bản ghi

        // Truyền các sản phẩm vào view
        return view('layouts.wishlist', compact('salenews','wishlist'));
    }

    public function destroy(Like $like)
{
    // Xóa mục yêu thích
    $like->delete();
    
    // Trả về thông báo thành công qua JSON
    return response()->json([
        'success' => true,
        'message' => 'Sale news has been removed from favorites list.'
    ]);
}
// headeer


    
    
    

    
    

}
