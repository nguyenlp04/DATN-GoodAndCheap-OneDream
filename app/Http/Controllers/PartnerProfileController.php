<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\ChannelInfo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your channels.');
        }

        $user = Auth::user();

        $profiles = Channel::where('user_id', $user->user_id)->get();

        if ($profiles->isEmpty()) {
            return redirect()->back()->with('error', 'No channels found for your account.');
        }

        return view('partner.profiles.profile_partners', compact('profiles'));
    }

    public function infomation()
    {
        $user = Auth::user();
        $channel = Channel::where('user_id', $user->user_id)->first(); // Lấy channel của user

        $channels = ChannelInfo::where('channel_id', $channel->channel_id)->get();

        return view('partner.infomation.channel_infomation', compact('channels'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createInfomation()
    {
        return view('partner.infomation.create_infomation');
    }

    public function storeInfomation(Request $request)
    {
        try {
            $user = Auth::user();

            $channel = Channel::where('user_id', $user->user_id)->first(); // Lấy channel của user
            $existingInfo = ChannelInfo::where('channel_id', $channel->channel_id)->first();

            if ($existingInfo) {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'This channel already has information.'
                ]);
            }

            $request->validate([
                'about' => 'required|string',
                'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $information = new ChannelInfo();
            $information->channel_id = $channel->channel_id; // Chỉ lấy giá trị cột channel_id
            $information->about = $request->input('about');

            if ($request->hasFile('banner_url')) {
                $imagePath = $request->file('banner_url')->store('channels/banners', 'public');
                $information->banner_url = $imagePath;
            }

            $information->save();

            return redirect()->route('channels.show', ['channel' => $channel->channel_id])->with('alert', [
                'type' => 'success',
                'message' => 'Channel information create successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    public function editInfomation(Request $request)
    {
        $channel = Channel::find($request->channel_id);
        if (!$channel) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Channel not found.'
            ]);
        }
        $info = $channel->info;
        return view('partner.infomation.edit_infomation', compact('channel', 'info'));
    }

    // Phương thức updateInfomation trong controller
    public function updateInfomation(Request $request)
    {
        $channel = Channel::find($request->channel_id);
        if (!$channel) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Channel not found.'
            ]);
        }

        if ($request->has('name_channel')) {
            $channel->name_channel = $request->name_channel;
        }

        $info = $channel->info;
        if ($info) {
            if ($request->has('about')) {
                $info->about = $request->about;
            }
            if ($request->hasFile('banner_url')) {
                $file = $request->file('banner_url');
                $path = $file->store('banners', 'public');
                $info->banner_url = $path;
            }
            $info->save();
        } else {
            $channel->info()->create([
                'about' => $request->input('about', ''),
                'banner_url' => $request->hasFile('banner_url')
                    ? $request->file('banner_url')->store('banners', 'public')
                    : null,
            ]);
        }

        $channel->save();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Update successfully.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $channel_id)
    {
        try {
            // Tìm kênh theo ID
            $channel = Channel::findOrFail($channel_id);

            // Kiểm tra thông tin trùng lặp với các kênh khác
            $existingChannel = Channel::where(function ($query) use ($request) {
                $query->where('name_channel', $request->input('name_channel'))
                    ->orWhere('phone_number', $request->input('phone_number'))
                    ->orWhere('address', $request->input('address'));
            })
                ->where('channel_id', '!=', $channel_id)
                ->first();

            // Nếu có kênh trùng thông tin, trả về thông báo lỗi
            if ($existingChannel) {
                return redirect()->back()->with('error', 'A channel with this information already exists. Please check the details.');
            }


            // Cập nhật thông tin kênh
            $channel->name_channel = $request->input('name_channel');
            $channel->phone_number = $request->input('phone_number');
            $channel->address = $request->input('address');

            // Nếu cần, cập nhật thêm các trường khác như email (thông qua user)
            if ($request->has('email')) {
                $channel->user->update(['email' => $request->input('email')]);
            }
            if ($request->hasFile('image_channel')) {
                // Xóa ảnh cũ nếu có
                if ($channel->image_channel) {
                    Storage::delete('public/' . $channel->image_channel);
                }


                if ($request->hasFile('image_channel')) {
                    $path = $request->file('image_channel')->store('channels', 'public'); // Thêm tiền tố '/storage/' vào đường dẫn
                    $channel->image_channel = 'storage/' . $path;
                }
            }
            // Lưu thông tin
            $channel->save();

            // Trả về view với dữ liệu đã cập nhật
            $user = Auth::user();
            $profiles = Channel::where('user_id', $user->user_id)->get();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Update infomation Successfully !'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('partners.profile')->with('alert', [
                'type' => 'error',
                'message' => 'Update infomation channel unsuccessful!'
            ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
}
