<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Notification;
use App\Models\User;
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

        foreach ($notifications as $notification) {
            if (!empty($notification->selected_users)) {
                // Lấy tên người dùng từ selected_users
                $userIds = $notification->selected_users;
                $notification->names = User::whereIn('user_id', $userIds)->pluck('full_name')->toArray();
            } elseif (!empty($notification->selected_channels)) {
                // Lấy tên kênh từ selected_channels
                $channelIds = $notification->selected_channels;
                $notification->names = Channel::whereIn('channel_id', $channelIds)->pluck('name_channel')->toArray();
            } else {
                $notification->names = ['No users or channels assigned'];
            }
        }

        return view('admin.notifications.list_notifications', compact('notifications'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $channels = Channel::all();
        $users = User::all();
        return view('admin.notifications.create_notifications', compact('users', 'channels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title_notification' => 'required|string',
            'content_notification' => 'required|string',
            'status' => 'nullable|in:public,private',
            'type' => 'required|string',
            'selected_users.*' => 'required_if:type,user|array|min:1',
            'selected_users.*' => 'exists:users,user_id',
            'selected_channels.*' => 'required_if:type,channel|array|min:1',
            'selected_channels.*' => 'exists:channels,channel_id',
        ], [
            'selected_users.required_if' => 'Please select at least one user to send the notification to.',
            'selected_users.exists' => 'Selected user does not exist in the system.',
            'selected_channels.required_if' => 'Please select at least one channel to send the notification to.',
            'selected_channels.exists' => 'Selected channel does not exist in the system.',
        ]);

        // Create a new notification record
        $notification = new Notification();
        $notification->title_notification = $request->title_notification;
        $notification->content_notification = $request->content_notification;
        $notification->type = $request->type;
        $notification->status = $request->status ?? 'public'; // Default to 'private'
        $notification->selected_users = json_encode($request->selected_users); // Store users as JSON
        $notification->selected_channels = json_encode($request->selected_channels); // Store channels as JSON
        $notification->save();

        // Redirect with a success message
        return redirect()->route('notifications.index')->with('alert', [
            'type' => 'success',
            'message' => 'Notification created successfully!',
        ]);
    }
    public function showNotifications()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve notifications for the specified user
        $notifications = Notification::where('status', 'public')
            ->orWhere(function ($query) use ($userId) {
                $query->where('status', 'private')
                    ->whereJsonContains('selected_users', $userId);
            })
            ->get();

        return view('user.notifications', compact('notifications'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.notifications.show', compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $notifications = Notification::findOrFail($id);

        // Decode JSON fields
        $notifications->selected_users = is_string($notifications->selected_users)
            ? json_decode($notifications->selected_users, true)
            : $notifications->selected_users;

        $notifications->selected_channels = is_string($notifications->selected_channels)
            ? json_decode($notifications->selected_channels, true)
            : $notifications->selected_channels;

        // Lấy danh sách user và channel
        $users = User::all();
        $channels = Channel::all();

        return view('admin.notifications.edit_notifications', compact('notifications', 'users', 'channels'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title_notification' => 'required|string',
            'content_notification' => 'required|string',
            'type' => 'required|string',
            'selected_users.*' => 'required_if:type,user|array|min:1|exists:users,user_id',
            'selected_channels.*' => 'required_if:type,channel|array|min:1|exists:channels,channel_id',
        ]);

        $notification = Notification::findOrFail($id);
        $notification->title_notification = $request->title_notification;
        $notification->content_notification = $request->content_notification;
        $notification->type = $request->type;
        $notification->selected_users = json_encode($request->selected_users ?? []);
        $notification->selected_channels = json_encode($request->selected_channels ?? []);
        $notification->save();

        return redirect()->route('notifications.index')->with('alert', [
            'type' => 'success',
            'message' => 'Notification updated successfully!',
        ]);
    }

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

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Notification deleted in trash successfully!'
        ]);
    }
    public function trashed()
    {
        $notifications = Notification::onlyTrashed()->get();

        return view('admin.notifications.trashed_notifications', compact('notifications'));
    }

    public function restore($id)
    {
        $notifications =  Notification::withTrashed()->findOrFail($id);
        $notifications->restore();
        return redirect()->route('notifications.index')->with('alert', [
            'type' => 'success',
            'message' => 'Notification restore successfully!'
        ]);
    }
    public function forceDelete($id)
    {
        $notifications = Notification::onlyTrashed()->findOrFail($id);
        $notifications->forceDelete();
        return redirect()->route('notifications.index')->with('alert', [
            'type' => 'success',
            'message' => 'Notification deleted permanently successfully'
        ]);
    }

    public function toggleStatus(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->status = $notification->status === "public" ? "private" : "public";
        $notification->save();
        return response()->json([
            'status' => $notification->status,
            'message' => 'Status notifications update successfully.',
        ]);
    }
}
