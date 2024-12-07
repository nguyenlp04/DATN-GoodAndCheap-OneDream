<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

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

        $request->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Đăng xuất người dùng (web guard)
        Auth::guard('web')->logout();

        // Hủy session người dùng
        // $request->session()->invalidate();

        // Tạo lại session mới sau khi đăng xuất
        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ hoặc trang login
        return redirect('/');
    }
}
