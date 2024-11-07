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
        // Giả sử bạn đang sử dụng Laravel Auth để lấy `user_id` của người dùng đã đăng nhập
        $userId = Auth::id();

        // Lấy danh sách đơn hàng của người dùng hiện tại cùng thông tin phương thức thanh toán và tên người dùng
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'payment_method.content as payment_method_name', 'users.full_name')
            ->where('orders.user_id', $userId)
            ->get();

        // Lấy thông tin chi tiết cho từng đơn hàng
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

        // Trả về view cùng dữ liệu đơn hàng
        return view('account.orders', compact('orders'));
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
        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Xác thực các trường form
        // $request->validate([
        //     'full_name' => 'required|string|max:255',
        //     'email' => [
        //         'required',
        //         'email',
        //         'max:255',
        //         Rule::unique('users')->ignore($user->id), // Sử dụng Rule::unique
        //     ],
        //     'address' => 'required|string|max:255',
        //     'phone_number' => 'required|string|max:15',
        //     'image_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
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
        // Dữ liệu cần cập nhật
        $updateData = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
        ];
        // Nếu có ảnh được upload
        if ($request->hasFile('image_user')) {
            // Xóa ảnh cũ nếu có
            if ($user->image_user) {
                if ($user->image_user) {
                    $oldImagePath = public_path('storage/' . $user->image_user);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Xóa tệp
                    } else {
                        // \Log::info("File does not exist: " . $oldImagePath); // Ghi log nếu không tìm thấy tệp
                    }
                }
            }
            // Tạo tên file với định dạng 'user' + thời gian + phần mở rộng
            $imageName = 'user' . time() . '.' . $request->file('image_user')->extension();
            // Lưu file vào thư mục 'image_users' với tên tùy chỉnh
            $image_userPath = $request->file('image_user')->storeAs('image_users', $imageName, 'public');
            // Thêm đường dẫn ảnh vào dữ liệu cập nhật
            $updateData['image_user'] = $image_userPath;
        }



        // Cập nhật thông tin người dùng
        DB::table('users')->where('user_id', $user->user_id)->update($updateData);

        // Chuyển hướng với thông báo thành công
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
