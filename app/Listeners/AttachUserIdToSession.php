<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;

class AttachUserIdToSession
{
    /**
     * Create the event listener.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $s_id = session()->getId();
    }
}