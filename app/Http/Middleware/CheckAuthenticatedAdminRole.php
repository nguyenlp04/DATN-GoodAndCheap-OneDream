<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticatedAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::guard('staff')->check() || !isset(Auth::guard('staff')->user()->staff_id)) {
            return redirect('/staff/login');
        } else if (Auth::guard('staff')->user()->role == 'admin') {
            return $next($request);
        } else if (Auth::guard('staff')->user()->role == 'staff') {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'You cannot access this feature !'
            ]);
        }

        return $next($request);
    }
}