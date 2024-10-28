<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification as RequestsNotification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsNotification $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['user_id'] = Auth::id();

        Notification::create($data);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notifications = Notification::findOrFail($id);
        return view('admin.notifications.show', compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notifications = Notification::findOrFail($id);
        return view('admin.notifications.edit', compact('notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsNotification $request, string $id)
    {
        $notifications = Notification::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($notifications->image_notification) {
                Storage::disk('public')->delete($notifications->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $notifications->update($data);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully');
    }
    // public function updateStatus(Request $request, $id)
    // {
    //     $notification = Notification::findOrFail($id);
    //     $notification->status = $request->input('status');
    //     $notification->save();

    //     return redirect()->back()->with('success', 'Status updated successfully');
    // }

    // public function updateType(Request $request, $id)
    // {
    //     $notification = Notification::findOrFail($id);
    //     $notification->type = $request->input('type');
    //     $notification->save();

    //     return redirect()->back()->with('success', 'Type updated successfully');
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notifications = Notification::findOrFail($id);
        if ($notifications->image_notification) {
            Storage::disk('public')->delete($notifications->image_notification);
        }

        $notifications->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully');
    }

    public function toggleStatus($id)
    {
        // Lấy ID người dùng hiện tại
        $userId = Auth::id();

        // Tìm bài viết bằng ID
        $notifications = Notification::findOrFail($id);

        // Chuyển đổi trạng thái (1: Hiện, 0: Ẩn)
        $notifications->status = $notifications->status == 1 ? 0 : 1;
        $notifications->save();

        // Trả về phản hồi JSON với trạng thái mới
        return response()->json([
            'status' => $notifications->status,
            'message' => 'Trạng thái bài viết đã được cập nhật thành công.',
        ]);
    }
}
