<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AdminForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.admin-forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email field
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send reset link to email
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        // Return with status
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function broker()
    {
        return Password::broker('users'); // Or 'admins' if using custom provider
    }
}
