<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticatedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::guard('staff')->check() || !isset(Auth::guard('staff')->user()->staff_id)) {
            session()->put('url.intended', url()->current());
            return redirect()->route('staff.login');
        }
        //check status &&


        if (Auth::guard('staff')->user()->status != 1) {
            Auth::guard('staff')->logout();
            return redirect('/staff/login')->with('alert', [
                'type' => 'error',
                'message' => 'Your account has been locked. Please contact the administrator.',
            ]);
        }
        return $next($request);
    }
}
