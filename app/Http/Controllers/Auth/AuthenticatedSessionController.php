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

    // Thay đổi logic chuyển hướng
    if (url()->previous() === route('toggleWishlist')) {
        return redirect()->route('home'); // Luôn chuyển hướng về trang chủ nếu đến từ toggleWishlist
    }

    $request->session()->forget('url.intended'); // Xóa URL trước đó
    return redirect()->route('home');
    
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
