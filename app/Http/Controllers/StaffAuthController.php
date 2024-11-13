<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;

class StaffAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.staff-login'); // Tạo view login cho nhân viên
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('staff')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        // Đăng xuất nhân viên
        Auth::guard('staff')->logout();

        // Hủy session nhân viên
        // $request->session()->invalidate();

        // Tạo lại session mới sau khi đăng xuất
        $request->session()->regenerateToken();

        // Chuyển hướng về trang đăng nhập của nhân viên
        return redirect()->route('staff.login');
    }
}
