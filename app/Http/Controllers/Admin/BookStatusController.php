<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookStatusController extends Controller
{
    public function status($id)
    {
        $book = Book::find($id);
        $book->status = !$book->status;
        $book->save();

        return redirect()->back()->with('success', 'Book status updated successfully.');
    }
}
