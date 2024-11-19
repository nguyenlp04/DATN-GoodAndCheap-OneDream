<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Sale_news;
use App\Models\VipPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_channel()
    {
        $channels = Channel::all(); // Lấy danh sách kênh với phân trang
        return view('admin.channels.list_channel', compact('channels'));
    }
    public function index()
    {
        $user = Auth::user();
        // Lấy kênh của người dùng hiện tại
        $channels = Channel::where('user_id', $user->user_id)->first();

        // Kiểm tra nếu người dùng chưa có kênh
        if (!$channels) {
            return redirect()->route('channels.create') // Hoặc trang tạo kênh của bạn
                ->with('error', 'You have not created a channel yet.');
        }
        $sale_news = $channels->saleNews()->get();
        $NewsCount = $channels->saleNews()->count();

        // Nếu có kênh, tiếp tục xử lý
        return view('partner.channels.profile_channels', compact('channels', 'NewsCount', 'sale_news'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Kiểm tra nếu người dùng đã tạo kênh
        $channelExists = Channel::where('user_id', $user->user_id)->exists();
        if ($channelExists) {
            return redirect()->route('channels.show', ['channel' => $user->channel->channel_id])
                ->with('success', 'You already have a channel.');
        }

        $vipPackages = VipPackage::all(); // Lấy tất cả các gói VIP
        return view('partner.channels.create_channels', compact('vipPackages')); // Truyền gói VIP vào view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã có kênh chưa
        $user = Auth::user();

        $existingChannel = Channel::where('user_id', $user->user_id)->first();
        if ($existingChannel) {
            return redirect()->route('channels.index')->with('success', 'You have already created a channel.');
        }

        // Validate form inputs
        $request->validate([
            'name_channel' => 'required|string|max:255|unique:channels,name_channel',
            'phone_number' => 'required|string|max:15|unique:channels,phone_number|regex:/^(\+?\d{1,4}[\s\-])?(\(?\d{1,3}\)?[\s\-]?)?[\d\s\-]{5,15}$/',
            'address' => 'required|string|max:255|unique:channels,address',
            'image_channel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vip_package_id' => 'nullable|exists:vip_packages,id', // Kiểm tra ID gói VIP hợp lệ
            'status' => 'nullable|integer'
        ]);

        // Lưu kênh mới
        $channel = new Channel();
        $channel->user_id = $user->user_id;
        $channel->name_channel = $request->name_channel;
        $channel->phone_number = $request->phone_number;
        $channel->address = $request->address;
        $channel->status = $request->status;
        $channel->vip_package_id = $request->vip_package_id; // Lưu gói VIP nếu có

        // Xử lý ảnh kênh
        if ($request->hasFile('image_channel')) {
            $channel->image_channel = $request->file('image_channel')->store('channels', 'public');
        }

        $channel->save();
        return redirect()->route('channels.show', ['channel' => $channel->channel_id])->with('alert', [
            'type' => 'success',
            'message' => 'Channel created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Kiểm tra nếu người dùng đã tạo kênh
        $channel = Channel::where('user_id', $user->user_id)->first();

        // Nếu người dùng có kênh thì tiếp tục hiển thị kênh
        $channels = Channel::findOrFail($id); // Lấy kênh theo ID


        $sale_news = $channels->saleNews()->get();

        // Đếm số lượng bản tin mà kênh đã đăng
        $NewsCount = $channels->saleNews()->count();

        return view('partner.channels.show_channels', compact('channels', 'NewsCount', 'sale_news'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $channels = Channel::findOrFail($id); // Lấy kênh theo ID
        $vipPackages = VipPackage::all(); // Lấy tất cả các gói VIP
        return view('admin.channels.edit_channel', compact('channels', 'vipPackages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate form inputs
        $request->validate([
            'name_channel' => 'required|string|max:255|unique:channels,name_channel,' . $id . ',channel_id',
            'phone_number' => 'required|string|max:15|unique:channels,phone_number,' . $id . ',channel_id|regex:/^(\+?\d{1,4}[\s\-])?(\(?\d{1,3}\)?[\s\-]?)?[\d\s\-]{5,15}$/',
            'address' => 'required|string|max:255|unique:channels,address,' . $id . ',channel_id',
            'image_channel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vip_package_id' => 'nullable|', // Kiểm tra ID gói VIP hợp lệ
            'status' => 'nullable|integer'
        ]);

        // Cập nhật kênh
        $channel = Channel::findOrFail($id);
        $channel->name_channel = $request->name_channel;
        $channel->phone_number = $request->phone_number;
        $channel->address = $request->address;
        $channel->status = $request->status;
        $channel->vip_package_id = $request->vip_package_id; // Cập nhật gói VIP

        // Xử lý ảnh (nếu có)
        if ($request->hasFile('image_channel')) {
            if ($channel->image_channel) {
                Storage::delete('public/' . $channel->image_channel); // Xóa ảnh cũ nếu có
            }
            $channel->image_channel = $request->file('image_channel')->store('channels', 'public');
        }

        $channel->save();
        return redirect()->route('channels.show', ['channel' => $channel->channel_id])->with('alert', [
            'type' => 'success',
            'message' => 'Channel updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $channel = Channel::findOrFail($id);

        // Xóa ảnh nếu có
        if ($channel->image_channel) {
            Storage::delete('public/' . $channel->image_channel);
        }

        $channel->delete(); // Xóa kênh
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Channel deleted successfully.',
        ]);
    }
}
