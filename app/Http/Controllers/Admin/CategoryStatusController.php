<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryStatusController extends Controller
{
    public function status($id){
        $categories = Category::find($id);
        $categories->status = !$categories->status;
        $categories->save();

        
 return response()->json($categories->status);

        // return redirect()->back()->with( 'success' ,$message);
    }


   
}
