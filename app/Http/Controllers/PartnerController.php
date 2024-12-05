<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_notification()
    {
        $notifications = Notification::all(); // Lấy tất cả thông báo

        foreach ($notifications as $notification) {
            if (!empty($notification->selected_users)) {
                $notification->selected_users = is_string($notification->selected_users)
                    ? json_decode($notification->selected_users, true)
                    : $notification->selected_users;

                if (is_array($notification->selected_users)) {
                    $userIds = $notification->selected_users;
                    $notification->user_names = User::whereIn('user_id', $userIds)->pluck('full_name')->toArray();
                }
            }

            if (!empty($notification->selected_channels)) {
                $notification->selected_channels = is_string($notification->selected_channels)
                    ? json_decode($notification->selected_channels, true)
                    : $notification->selected_channels;

                if (is_array($notification->selected_channels)) {
                    $channelIds = $notification->selected_channels;
                    $notification->channel_names = Channel::whereIn('channel_id', $channelIds)->pluck('name_channel')->toArray();
                }
            }
        }

        return view('partner.notifications.list', compact('notifications'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
