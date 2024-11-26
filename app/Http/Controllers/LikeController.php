<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\SaleNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Controller code for handling adding to wishlist
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

}

