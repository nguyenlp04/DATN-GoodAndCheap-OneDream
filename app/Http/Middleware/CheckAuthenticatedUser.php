<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            session()->put('url.intended', url()->current());
            return redirect()->route('login');
        }
        $user = Auth::user();
        if ($user->is_delete != 0) {
            Auth::logout();
            return redirect()->route('login')->with('alert', [
                'type' => 'error',
                'message' => 'Your account has been deleted. Please contact the administrator.',
            ]);
        }
        if ($user->status != 1) {
            Auth::logout();
            return redirect()->route('login')->with('alert', [
                'type' => 'error',
                'message' => 'Your account has been locked.',
            ]);
        }
        return $next($request);
    }
}
