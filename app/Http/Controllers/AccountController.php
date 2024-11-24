<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.dashboard');
    }
    public function showOrders()
    {
        $userId = Auth::id(); // Lấy user_id của người dùng hiện tại
        // Lấy tất cả thông tin đơn hàng của người dùng từ bảng 'orders'
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->select(
                'orders.order_id',
                'orders.user_id',
                'orders.created_at',
                'orders.name_receiver',
                'orders.price',
                'orders.phone_number',
                'orders.address',
                'users.full_name',
                'users.image_user',
                'users.email',
                'payment_method.name_method'
            )
            ->where('orders.user_id', $userId) // Lấy tất cả đơn hàng của người dùng
            ->orderBy('orders.created_at', 'desc') // Sắp xếp theo ngày tạo đơn hàng
            ->get();

        // Lặp qua các đơn hàng và lấy thông tin chi tiết sản phẩm trong mỗi đơn hàng
        foreach ($orders as $order) {
            $orderDetails = DB::table('order_details')
                ->join('products', 'order_details.product_id', '=', 'products.product_id')
                ->leftJoin('photo_gallery', function ($join) {
                    $join->on('products.product_id', '=', 'photo_gallery.product_id')
                        ->whereRaw('photo_gallery.photo_gallery_id = (SELECT MIN(photo_gallery_id) FROM photo_gallery WHERE photo_gallery.product_id = products.product_id)');
                })
                // Thêm join với bảng 'channels' nếu 'channel_id' không null
                ->leftJoin('channels', 'products.channel_id', '=', 'channels.channel_id')
                // Thêm join với bảng 'reviews' để lấy thông tin đánh giá sản phẩm
                ->leftJoin('reviews', 'order_details.detail_order_id', '=', 'reviews.detail_order_id')
                ->select(
                    'products.product_id',
                    'products.name_product',
                    'products.price as product_price',
                    'products.description',
                    'products.staff_id',
                    'products.channel_id',
                    'order_details.detail_order_id',
                    'order_details.value',
                    'order_details.status as detail_status', // Trạng thái chi tiết sản phẩm từ bảng order_details
                    'order_details.is_reviewed',
                    'order_details.stock',
                    DB::raw('products.price * order_details.value as total_price'),
                    'photo_gallery.image_name as product_image', // Ảnh đầu tiên của sản phẩm
                    'channels.name_channel', // Lấy tên kênh nếu có channel_id
                    'reviews.review_id',
                    'reviews.content as review_content',
                    'reviews.rating',
                    'reviews.created_at as review_created_at'
                )
                ->where('order_details.order_id', $order->order_id) // Lấy chi tiết sản phẩm của đơn hàng
                ->get();

            // Thêm thông tin chi tiết sản phẩm vào đơn hàng
            $order->order_details = $orderDetails;
        }
        // dd($orders);
        $allOrders = $orders;
        $pendingOrders = $orders->filter(function ($order) {
            return $order->order_details->contains('detail_status', 'pending');
        });
        $processingOrders = $orders->filter(function ($order) {
            return $order->order_details->contains('detail_status', 'in_progress');
        });
        $shippingOrders = $orders->filter(function ($order) {
            return $order->order_details->contains('detail_status', 'shipped');
        });
        $completedOrders = $orders->filter(function ($order) {
            return $order->order_details->contains('detail_status', 'completed');
        });
        $canceledOrders = $orders->filter(function ($order) {
            return $order->order_details->contains('detail_status', 'canceled');
        });
        return view('account.orders', compact('orders', 'allOrders', 'pendingOrders', 'processingOrders', 'shippingOrders', 'completedOrders', 'canceledOrders', 'canceledOrders'));
    }
    public function showManager()
    {
        return view('account.manager');
    }
    public function showAddress()
    {
        return view('account.address');
    }
    public function showDetails()
    {
        return view('account.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $emailRules = ['required', 'email', 'max:255'];

        if ($request->input('email') !== $user->email) {
            $emailRules[] = Rule::unique('users')->ignore($user->id);
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => $emailRules,
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'image_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $updateData = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
        ];
        if ($request->hasFile('image_user')) {
            if ($user->image_user) {
                if ($user->image_user) {
                    $oldImagePath = public_path($user->image_user);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Xóa tệp
                    } else {
                        // \Log::info("File does not exist: " . $oldImagePath); // Ghi log nếu không tìm thấy tệp
                    }
                }
            }
            $imageName = 'user' . time() . '.' . $request->file('image_user')->extension();
            $image_userPath = $request->file('image_user')->storeAs('image_users', $imageName, 'public');
            $updateData['image_user'] = 'storage/' . $image_userPath;
        }
        DB::table('users')->where('user_id', $user->user_id)->update($updateData);
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
