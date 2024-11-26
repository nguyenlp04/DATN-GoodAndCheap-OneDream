<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\SaleNews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
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
