<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            // Xác thực dữ liệu đầu vào
            $validatedData = $request->validate([
                'rating_' . $request->product_id => 'required|integer|between:1,5',
                'review_content_' . $request->product_id => 'nullable|string|max:500',
                'detail_order_id' => 'required|integer',
                'product_id' => 'required|integer',
            ], [
                'rating_' . $request->product_id . '.required' => 'Vui lòng cung cấp số sao đánh giá.',
                'rating_' . $request->product_id . '.integer' => 'Số sao phải là một số nguyên.',
                'rating_' . $request->product_id . '.between' => 'Số sao phải nằm trong khoảng từ 1 đến 5.',
                'review_content_' . $request->product_id . '.nullable' => 'Nội dung đánh giá có thể bỏ qua nếu bạn chỉ muốn đánh giá bằng sao.',
                'review_content_' . $request->product_id . '.max' => 'Nội dung đánh giá không được vượt quá 500 ký tự.',
            ]);
            // Tạo đánh giá
            $review = new Review();
            $review->user_id = Auth::id();
            $review->product_id = $request->product_id;
            $review->detail_order_id = $request->detail_order_id;
            $review->rating = $request->input('rating_' . $request->product_id);
            $review->content = $request->input('review_content_' . $request->product_id);
            $review->status = '1';
            $review->created_at = now();

            $review->save();
            DB::table('order_details')
                ->where('detail_order_id', $request->detail_order_id)
                ->update(['is_reviewed' => 'reviewed']);
            // Chuyển hướng lại với thông báo thành công
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Đánh giá đã được gửi thành công.'
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi và chuyển hướng lại với thông báo lỗi
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ]);
        }
    }
    public function replyToReview(Request $request)
    {
        try {
            $request->validate([
                'review_id' => 'required|exists:reviews,review_id',
                'content' => 'required|string'
            ]);
            $reviewId = $request->input('review_id');
            $content = $request->input('content');
            // $staffId = Auth::guard('staff')->user()->staff_id;
            $staffId = 3;
            // Tạo một bản ghi mới cho phản hồi của staff
            DB::table('reviews')->insert([
                'parent_id' => $reviewId,
                'user_id' => null,
                'staff_id' => $staffId,
                'product_id' => null,
                'sale_new_id' => null,
                'content' => $content,
                'status' => 1,
                'created_at' => now(),
                'rating' => null,
                'detail_order_id' => null,
                'channel_id' => null,
                'updated_at' => now()
            ]);

            // Cập nhật status của review ban đầu thành 0
            DB::table('reviews')
                ->where('review_id', $reviewId)
                ->update(['status' => 0]);



            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Đã trả lời'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ]);
        }
    }
}
