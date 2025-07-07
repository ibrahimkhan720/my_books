<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorStatusController extends Controller
{
    public function status($id){
        $author = Author::find($id);
        $author->status = !$author->status;
        $author->save();

        $message = ($author->status) ? 'Active author' : 'Deactive author' ;

        return redirect()->back()->with('success', $message);
    }
}
