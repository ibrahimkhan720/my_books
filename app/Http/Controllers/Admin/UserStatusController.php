<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserStatusController extends Controller
{
    public function status($id){
        $users = User::find($id);
        $users->status = !$users->status;
        $users->save();

        return redirect()->back()->with('success' , 'status update successfully');
    }
}
