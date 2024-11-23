<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\SaleNews;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
     
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thêm vào danh sách yêu thích'], 401);
        }

        $userId = Auth::id(); 
        $saleNewsId = $request->input('sale_news_id'); 

        $saleNews = SaleNews::find($saleNewsId);
        if (!$saleNews) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }

        // Kiểm tra xem sản phẩm đã được yêu thích chưa
        $existingLike = Like::where('user_id', $userId)
            ->where('sale_new_id', $saleNewsId)
            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'Sản phẩm đã có trong danh sách yêu thích'], 200);
        }

        // Tạo bản ghi mới trong bảng likes
        Like::create([
            'user_id' => $userId,
            'sale_new_id' => $saleNewsId,
        ]);

        return response()->json(['message' => 'Thêm vào danh sách yêu thích thành công'], 201);
    }
}
