<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('Admin.profile.index', compact('users'));
    }

    public function changepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Old password is incorrect'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save(); 
        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function update(Request $request , string $id){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'designation' => 'required',
        'bio' => 'required',
        'email' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $fileName = null;

    if ($request->hasFile('user_img')) {
        $file = $request->file('user_img');
        $fileName = md5($file->getClientOriginalName()) . '_' . time() . '_' . date('y,m,d') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/admin/uploads/user_image'), $fileName);
    }

    $user = User::find($id);
    $currentimage = $user->user_image;

    $user->update([
        'name' => $request->name,
        'designation' => $request->designation,
        'bio' => $request->bio,
        'user_image' => ($fileName) ? $fileName : $currentimage,
        'email' => $request->email,
    ]);

    if ($fileName) {
        File::delete(public_path('/admin/uploads/user_image/' . $currentimage));
    }

    return redirect()->route('user.index')->with('success', 'user update successfully');
}
}