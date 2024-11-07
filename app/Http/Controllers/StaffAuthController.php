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
            return redirect()->intended('staff/dashboard'); // Điều hướng đến dashboard của nhân viên sau khi đăng nhập thành công
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff.login');
    }
}
