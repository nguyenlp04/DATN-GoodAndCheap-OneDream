<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class StaffResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('auth.staff-reset-password', [
            'request' => $request,
            'token' => $token,
            'email' => $request->email, // Nếu bạn cần email
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staffs,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker('staffs')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($staff, $password) {
                $staff->password = Hash::make($password);
                $staff->save();
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('staff.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
