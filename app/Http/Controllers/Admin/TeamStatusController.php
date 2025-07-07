<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
class TeamStatusController extends Controller
{
    public function status($id){
        $teams = Team::find($id);
        $teams->status = !$teams->status;
        $teams->save();

        return redirect()->back()->with('success' , 'status update successfully');
    }
}
