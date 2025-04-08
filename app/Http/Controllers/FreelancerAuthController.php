<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FreelancerAuthController extends Controller
{
    public function showPasswordForm(Request $request)
    {
        return view('freelancers.set-password', [
            'email' => $request->query('email'),
            'token' => $request->query('token')
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //validate the token
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password Set Successfuly.');
        }

        return back()->withErrors(['email' => 'Invalid token or email.']);
    }
}
