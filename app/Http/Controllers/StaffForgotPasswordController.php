<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;

class StaffForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.staff-forgot-password'); // View nhập email cho staffs
    }
    public function __construct()
    {
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return url(route('staff.password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false));
        });
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staffs,email',
        ], [
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);

        $status = Password::broker('staffs')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
