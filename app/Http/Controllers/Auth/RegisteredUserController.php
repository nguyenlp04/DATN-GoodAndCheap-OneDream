<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        // Tạo mã xác minh
        $verificationCode = rand(100000, 999999);

        // Lưu tạm thời thông tin người dùng vào session
        $request->session()->put('user_data', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
            'verification_code' => $verificationCode,
        ]);

        // Gửi email xác minh
        Mail::to($request->email)->send(new VerificationMail($verificationCode));

        // Chuyển hướng đến trang nhập mã xác minh
        return redirect()->route('verification.show')->with('email', $request->email);
    }
}
