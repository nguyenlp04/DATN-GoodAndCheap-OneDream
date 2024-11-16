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
        return view('admin.notifications.list_notifications', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notifications.create_notifications');
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
    public function edit($id)
    {
        $notifications = Notification::findOrFail($id);
        return view('admin.notifications.edit_notifications', compact('notifications'));
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
