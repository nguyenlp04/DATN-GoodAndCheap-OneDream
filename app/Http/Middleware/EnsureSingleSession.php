<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnsureSingleSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth()->user()->user_id;
            // dd($userId);
            $currentSessionId = session()->getId();
            $activeSessions = DB::table('sessions')
                ->where('user_id', $userId)
                ->get();
            // Logout tất cả các session khác
            foreach ($activeSessions as $session) {
                DB::table('sessions')->where('id', $session->id)->delete();
            }
        }

        return $next($request);
    }
}