<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng reviews
        $reviews = DB::table('comments')
            ->select(
                'comments.*',
                'users.full_name',
                'users.email',
                'users.image_user',
                'products.name_product',
                'products.description',
                DB::raw('(SELECT pg.image_name FROM photo_gallery AS pg WHERE pg.product_id = comments.product_id ORDER BY pg.photo_gallery_id ASC LIMIT 1) AS image_name')
            )
            ->leftJoin('users', 'comments.user_id', '=', 'users.user_id')
            ->leftJoin('products', 'comments.product_id', '=', 'products.product_id')
            ->orderBy('comments.comment_id', 'desc')
            ->get();



        // Trả về view và truyền dữ liệu vào view
        return view('admin.review.review-management', compact('reviews'));
    }
    public function store(Request $request)
    {
        try {
            // Lấy user ID
            $userId = Auth::id();

            // Kiểm tra yêu cầu đầu vào - xác thực mã đơn hàng
            $validatedData = $request->validate([
                'order_id' => 'required|integer',
            ], [
                'order_id.required' => 'Vui lòng cung cấp mã đơn hàng.',
            ]);

            $reviews = [];
            $validationErrors = [];
            $hasValidReview = false;  // Cờ kiểm tra có ít nhất một đánh giá hợp lệ

            // Duyệt qua các đánh giá để kiểm tra từng trường rating và content
            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'rating_') === 0) {
                    $productId = explode('_', $key)[1];

                    // Lấy rating và nội dung đánh giá cho sản phẩm
                    $rating = $request->input("rating_$productId");
                    $content = $request->input("review_content_$productId");

                    // Kiểm tra rating hợp lệ
                    if (empty($rating)) {
                        $validationErrors["rating_$productId"] = 'Vui lòng chọn số sao đánh giá.';
                    } elseif (!is_numeric($rating) || $rating < 1 || $rating > 5) {
                        $validationErrors["rating_$productId"] = 'Số sao phải là một số nguyên từ 1 đến 5.';
                    }

                    // Kiểm tra nội dung đánh giá hợp lệ
                    if (!empty($rating) && empty($content)) { // Nếu có rating mà không có content
                        $validationErrors["review_content_$productId"] = 'Vui lòng nhập nội dung đánh giá.';
                    } elseif (strlen($content) > 1000) { // Kiểm tra chiều dài nội dung
                        $validationErrors["review_content_$productId"] = 'Nội dung đánh giá không được vượt quá 1000 ký tự.';
                    }

                    // Nếu có lỗi, không tiếp tục thêm đánh giá vào mảng
                    if (!empty($validationErrors)) {
                        break; // Dừng vòng lặp nếu có lỗi
                    }

                    // Nếu không có lỗi, thêm đánh giá vào mảng
                    $reviews[] = [
                        'parent_id' => null,
                        'user_id' => $userId,
                        'staff_id' => null,
                        'product_id' => $productId,
                        'order_id' => $validatedData['order_id'],
                        'sale_new_id' => null,
                        'content' => $content,
                        'status' => 1,
                        'Star' => $rating,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $hasValidReview = true;  // Đánh dấu có ít nhất một đánh giá hợp lệ
                }
            }

            // Nếu có lỗi, chuyển hướng lại với lỗi
            if (!empty($validationErrors)) {
                return redirect()->back()->withErrors($validationErrors)->withInput();
            }

            // Kiểm tra nếu không có đánh giá hợp lệ nào
            if (!$hasValidReview) {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Vui lòng cung cấp đánh giá cho ít nhất một sản phẩm.'
                ])->withInput();
            }

            // Lưu đánh giá vào cơ sở dữ liệu
            DB::table('comments')->insert($reviews);

            // Cập nhật trạng thái đơn hàng là đã được đánh giá
            DB::table('orders')
                ->where('order_id', $validatedData['order_id'])
                ->update(['is_reviewed' => 'reviewed']);
            // Chuyển hướng với thông báo thành công
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Đánh giá của bạn đã được gửi thành công.'
            ]);
        } catch (\Exception $e) {
            // Chuyển hướng với thông báo lỗi
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }
}
