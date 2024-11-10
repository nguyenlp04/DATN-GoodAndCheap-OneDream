<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    public function index()
    {
        // Lấy danh sách đơn hàng cùng thông tin người dùng và phương thức thanh toán
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'payment_method.content as payment_method_name', 'users.full_name')
            ->orderBy('orders.order_id', 'desc')
            ->get();
        // Lấy thông tin chi tiết cho từng order
        foreach ($orders as $order) {
            $orderDetails = DB::table('order_details AS od')
                ->select(
                    'od.*',
                    'p.name_product AS name_product',
                    'p.price',
                    'pg.image_name AS first_image', // Ảnh đầu tiên
                    'c.name_channel',
                    'c.image_channel'
                )
                ->join('products AS p', 'od.product_id', '=', 'p.product_id')
                ->leftJoin('photo_gallery AS pg', 'pg.product_id', '=', 'od.product_id')
                ->join('channels AS c', 'od.channel_id', '=', 'c.channel_id')
                ->where('od.order_id', $order->order_id) // Lấy theo `order_id` của từng đơn hàng
                ->orderBy('pg.photo_gallery_id', 'asc') // Lấy ảnh đầu tiên
                ->get();

            // Gán danh sách chi tiết sản phẩm cho từng đơn hàng
            $order->order_details = $orderDetails;
        }

        return view('admin.orders.index', compact('orders'));
    }
    public function updateStatus(Request $request, $order_id)
    {
        $status = $request->input('status');
        DB::table('orders')
            ->where('order_id', $order_id)
            ->update(['status' => $status]);

        session()->flash('alert', ['type' => 'success', 'message' => 'Trạng thái đơn hàng đã được cập nhật.']);
        return response()->json(['success' => true, 'message' => 'Trạng thái đơn hàng đã được cập nhật.']);
    }

    public function cancel($order_id)
    {
        try {
            // Tìm đơn hàng theo order_id
            $order = DB::table('orders')->where('order_id', $order_id)->first();

            // Kiểm tra nếu đơn hàng tồn tại và có thể hủy được
            if ($order && $order->status != 'canceled') {
                // Cập nhật trạng thái đơn hàng thành 'canceled'
                DB::table('orders')
                    ->where('order_id', $order_id)
                    ->update(['status' => 'canceled']);

                // Thông báo thành công
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Đơn hàng đã được hủy thành công.'
                ]);
            }

            // Thông báo nếu không thể hủy đơn hàng
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Không thể hủy đơn hàng này.'
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }


    public function demo()
    {
        // Lấy danh sách đơn hàng cùng thông tin người dùng và phương thức thanh toán
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'payment_method.content as payment_method_name', 'users.full_name')
            ->get();

        // Lấy thông tin chi tiết cho từng order
        foreach ($orders as $order) {
            $orderDetails = DB::table('order_details AS od')
                ->select(
                    'od.*',
                    'p.name_product AS name_product',
                    'p.price',
                    'pg.image_name AS first_image', // Ảnh đầu tiên
                    'c.name_channel',
                    'c.image_channel'
                )
                ->join('products AS p', 'od.product_id', '=', 'p.product_id')
                ->leftJoin('photo_gallery AS pg', 'pg.product_id', '=', 'od.product_id')
                ->join('channels AS c', 'od.channel_id', '=', 'c.channel_id')
                ->where('od.order_id', $order->order_id) // Lấy theo `order_id` của từng đơn hàng
                ->orderBy('pg.photo_gallery_id', 'asc') // Lấy ảnh đầu tiên
                ->get();

            // Gán danh sách chi tiết sản phẩm cho từng đơn hàng
            $order->order_details = $orderDetails;
            dd($order);
        }
    }
}
