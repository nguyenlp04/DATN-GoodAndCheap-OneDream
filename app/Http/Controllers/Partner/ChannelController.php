<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;

use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Channel\StoreController;
use App\Http\Requests\Channel\UpdateController;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = Channel::all();
        return view('partner.channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partner.channels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreController $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image_channel')) {
            $data['image_channel'] = $request->file('image_channel')->store('channels', 'public');
        }
        $data['user_id'] = Auth::id();
        if (is_null($data['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User ID cannot be null. Please log in.']);
        }
        Channel::create($data);
        return redirect()->route('channels.index')->with('success', 'my channel created successfully');
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
        $channel = Channel::findOrFail($id); // Lấy kênh bằng ID
        return view('partner.channels.edit', compact('channel')); // Đảm bảo view đúng
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateController $request, string $id)
    {
        $data = $request->validated();
        $channel = Channel::findOrFail($id); // Tìm kênh bằng ID

        if ($request->hasFile('image_channel')) {
            $data['image_channel'] = $request->file('image_channel')->store('channels', 'public');
        }

        $channel->update($data); // Cập nhật kênh
        return redirect()->route('partner.channels.index')->with('success', 'Channel updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $channel = Channel::findOrFail($id);
        try {
            $channel->delete(); // Xóa kênh
            return redirect()->route('partner.channels.index')->with('success', 'Channel deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('partner.channels.index')->with('error', 'Error deleting channel');
        }
    }
}
