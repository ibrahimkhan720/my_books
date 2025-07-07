<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\register;
use Validator;
use Hash;

class RegistorController extends Controller
{
    // Form dikhana
    public function create()
    {
        return view('frontend.registar');
    }

    // Form submit karna
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registers,email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        register::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful. Please login.');
    }
}
