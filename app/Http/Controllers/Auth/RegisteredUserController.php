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

        $verificationCode = rand(100000, 999999);

        $request->session()->put('user_data', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
            'verification_code' => $verificationCode,
        ]);

        $request->session()->put('email', $request->email);

        Mail::to($request->email)->send(new VerificationMail($verificationCode));

        return redirect()->route('verification.show');
    }
}
