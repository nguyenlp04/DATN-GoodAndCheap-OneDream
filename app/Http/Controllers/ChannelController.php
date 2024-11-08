<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index()
{
    // Lấy tất cả các kênh từ cơ sở dữ liệu
    $channels = Channel::all();

    return view('partner.channels.profile_channels', compact('channels'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partner.channels.create_channels');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Kiểm tra xem người dùng đã tạo kênh chưa
    $user = Auth::user();

    // Kiểm tra nếu người dùng đã có kênh
    $existingChannel = Channel::where('user_id', $user->user_id)->first();

    if ($existingChannel) {
        return redirect()->route('channels.index')->with('success', 'You have already created a channel.');
    }

    // Validate form inputs
    $request->validate([
        'name_channel' => 'required|string|max:255|unique:channels,name_channel', // Kiểm tra tên kênh không bị trùng
        'phone_number' => 'required|string|max:15|regex:/^(\+?\d{1,4}[\s\-])?(\(?\d{1,3}\)?[\s\-]?)?[\d\s\-]{5,15}$/', // Kiểm tra số điện thoại hợp lệ
        'address' => 'required|string|max:255',
        'image_channel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'nullable|integer'
    ], [
        // Tùy chỉnh thông báo lỗi (nếu cần)
        'name_channel.required' => 'Channel name is required.',
        'phone_number.required' => 'Phone number is required.',
        'phone_number.regex' => 'Phone number is not valid.',
        'address.required' => 'Address is required.',
        'image_channel.image' => 'The file must be an image.',
        'image_channel.mimes' => 'Only jpeg, png, jpg, and gif images are allowed.',
        'image_channel.max' => 'Image size must not exceed 2MB.',
    ]);

    // Lưu kênh mới
    $channel = new Channel();
    $channel->user_id = $user->user_id;  // Đảm bảo rằng bạn đang sử dụng $user->id
    $channel->name_channel = $request->name_channel;
    $channel->phone_number = $request->phone_number;
    $channel->address = $request->address;

    // Xử lý ảnh (nếu có)
    if ($request->hasFile('image_channel')) {
        $channel->image_channel = $request->file('image_channel')->store('channels', 'public');
    }

    $channel->save();

    return redirect()->route('channels.index')->with('success', 'Channel created successfully.');
}


    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
