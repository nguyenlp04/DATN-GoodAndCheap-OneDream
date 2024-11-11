<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Lấy các sản phẩm từ bảng wishlist của người dùng
        $wishlist = Like::where('user_id', $userId)->get();

        // Lấy chi tiết các sản phẩm đã yêu thích
        $products = Product::whereIn('product_id', $wishlist->pluck('product_id'))->get();

        // Truyền các sản phẩm vào view
        return view('blocks.client.wishlist', compact('products'));
    }
}
