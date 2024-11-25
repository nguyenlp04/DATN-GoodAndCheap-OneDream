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
        dd($user->channel_id);

        $profiles = Channel::where('user_id', $user->user_id)->get();

        if ($profiles->isEmpty()) {
            return redirect()->back()->with('error', 'No channels found for your account.');
        }

        return view('partner.profiles.profile_partners', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createInfomation()
    {
        return view('partner.infomation.create_infomation');
    }
    public function infomation()
    {
        $infomations = ChannelInfo::all();
        return view('partner.infomation.list_infomation', compact('infomations'));
    }
    public function storeInfomation(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user->channel_id) {
                return redirect()->route('partners.infomation')->with('alert', [
                    'type' => 'error',
                    'message' => 'User does not have a valid channel.'
                ]);
            }

            $channelId = $user->channel_id;

            $request->validate([
                'about' => 'required|string',
                'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $information = new ChannelInfo();
            $information->channel_id = $channelId;
            $information->about = $request->input('about');
            $information->banner_url = $request->input('banner_url');

            if ($request->hasFile('banner_url')) {
                $imagePath = $request->file('banner_url')->store('channels/banners', 'public');
                $information->banner_url = $imagePath;
            }

            $information->save();

            return redirect()->route('partners.infomation')->with('alert', [
                'type' => 'success',
                'message' => 'Information added successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('partners.infomation')->with('alert', [
                'type' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
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
                ->where('channel_id', '!=', $channel_id) // Loại bỏ kênh hiện tại khỏi kiểm tra
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

                // Lưu ảnh mới
                $path = $request->file('image_channel')->store('images', 'public');
                $channel->image_channel = $path;
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
