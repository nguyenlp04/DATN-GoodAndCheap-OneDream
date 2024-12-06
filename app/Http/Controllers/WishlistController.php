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
    // Check if the user is logged in
    if (!$user) {
        if ($request->ajax()) {
            return response()->json(['type' => 'error', 'message' => 'You need to log in to add items to your favorites list.'], 401); // Return error if it's an AJAX request
        }
        return redirect()->route('login')->with('alert', ['type' => 'error', 'message' => 'You need to log in to add items to your favorites list.']);
    }

    // Validate the input data
    $request->validate([
        'sale_new_id' => 'required|integer|exists:sale_news,sale_new_id',
    ]);

    // Retrieve the product information
    $saleNews = SaleNews::find($request->sale_new_id);
 
    // Check if the product belongs to the logged-in user
    if ($saleNews->user_id == $user->user_id) {
        if ($request->ajax()) {
            return response()->json(['type' => 'error', 'message' => 'This is your own sale news. You cannot add it to your favorites list.'], 400);
        }
        return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'This is your own sale news. You cannot add it to your favorites list.']);
    }

    // Check if the product is already in the favorites list
    $existingLike = Like::where('user_id', $user->user_id)
                        ->where('sale_new_id', $request->sale_new_id)
                        ->first();

    if ($existingLike) {
        if ($request->ajax()) {
            return response()->json(['type' => 'error', 'message' => 'This item is already in your favorites list!'], 400); // Return error if it's an AJAX request
        }
        return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'This item is already in your favorites list!']);
    }

    // If not already added, add it to the favorites list
    Like::create([
        'user_id' => $user->user_id,
        'sale_new_id' => $request->sale_new_id,
        'status' => 1,
    ]);

    if ($request->ajax()) {
        return response()->json(['type' => 'success', 'message' => 'Item added to your favorites list successfully.']); // Return success message for AJAX
    }

    return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Item added to your favorites list successfully.']);

} catch (\Exception $e) {
    // If an error occurs, return an error message
    if ($request->ajax()) {
        return response()->json(['type' => 'error', 'message' => 'Error: ' . $e->getMessage()], 500);
    }

    return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
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