<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
class MediaStatusController extends Controller
{
    public function status($id){
        $media= Media::find($id);
        $media->status = !$media->status;
        $media->save();

        return redirect()->back()->with('success' , 'status update successfully');
    }
}
