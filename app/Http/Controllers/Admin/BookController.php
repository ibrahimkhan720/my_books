<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Countory;
use Validator;
use File;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchTerm = request()->get('q');
        $books = Book::latest()->with(['category' , 'author'])->where('title' , 'like' , "%$searchTerm%")->paginate(15);
        return view('Admin.book.index' , compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authores = Author::all();
        $countories = Countory::all();
        return view('Admin.book.create' , compact('categories' , 'authores','countories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all() , [
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'required|not_in:none',
            'author_id' => 'required|not_in:none',
            'availability' => 'required|not_in:none',
            'publisher' => 'required',
            'country_of_publisher' => 'required|not_in:none',
            'isbn' => 'required',
            'price' => 'required',
              'rating' => 'required',
            'isbn_10' => 'required',
            // 'book_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'book_upload' => 'required|mimes:pdf,epub|max:10240',
            'audience' => 'required',
            'format' => 'required',
            'language' => 'required',
            'total_pages' => 'required|integer|min:1',
            'edition_number' => 'required|integer|min:1',
            'recommended' => 'required|not_in:none',
            'description' => 'required',

        ],[
            'title.required' => 'The title field is required.',
            'slug.required' => 'The slug field is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.not_in' => 'Please select a valid category.',
            'author_id.required' => 'Please select an author.',
              'author_id.not_in' => 'Please select a valid author.',
            'availability.required' => 'Availability is required.',
            'availability.not_in' => 'Please select a valid availability option.',
            'publisher.required' => 'Publisher information is required.',
            'country_of_publisher.required' => 'Country of publisher is required.',
             'country_of_publisher.not_in' => 'Please select a valid country option.',
            'isbn.required' => 'ISBN is required.',
            'price.required' => 'price is required',
             'rating.required' => 'price is required',
            'isbn_10.required' => 'ISBN-10 is required.',
            // 'book_img.required' => 'Book image is required.',
            // 'book_img.image' => 'The file must be an image.',
            // 'book_img.mimes' => 'Allowed image formats: jpeg, png, jpg.',
            // 'book_img.max' => 'The image size cannot exceed 2MB.',
            // 'book_upload.required' => 'The book file is required.',
            // 'book_upload.mimes' => 'Allowed file formats: pdf, epub.',
            // 'book_upload.max' => 'The file size cannot exceed 10MB.',
            'audience.required' => 'Audience information is required.',
            'format.required' => 'Format is required.',
            'language.required' => 'Language information is required.',
            'total_pages.required' => 'Total pages is required.',
            'total_pages.integer' => 'Total pages must be a number.',
            'total_pages.min' => 'Total pages must be at least 1.',
            'edition_number.required' => 'Edition number is required.',
            'edition_number.integer' => 'Edition number must be a number.',
            'edition_number.min' => 'Edition number must be at least 1.',
            'recommended.required' => 'Recommended field is required.',
            'recommended.not_in' => 'Please select a valid recommendation option.',
            'description.required' => 'Description is required.',

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

              $fileName = null;
            if ($request->hasfile('book_img')) {
                $file = $request->file('book_img');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('/admin/uploads/book_img'), $fileName);
            }


            Book::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'author_id' => $request->author_id,
                'availability' => $request->availability,
                'price' => $request->price,
                 'rating' => $request->rating,
                'publisher' => $request->publisher,
                'country_of_publisher' => $request->country_of_publisher,
                'isbn' => $request->isbn,
                'isbn_10' => $request->isbn_10,
                'book_img' => $request->book_img,
                'book_upload' => $request->book_upload,
                'audience' => $request->audience,
                'format' => $request->format,
                'language' => $request->language,
                'total_pages' => $request->total_pages,
                'edition_number' => $request->edition_number,
                'recommended' => $request->recommended,
                'description' => $request->description,
                'downloaded' => $request->downloaded,
                'book_img' => $fileName,
                'status' => $request->status,
            ]);

            return redirect()->route('book.index')->with('success' , 'book create successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $authores = Author::all();
        $book = Book::find($id);
        $countories = Countory::all();
        return view('Admin.book.edit' , compact('book' , 'categories' , 'authores','countories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        $fileName = null;
            if ($request->hasfile('book_img')) {
                $file = $request->file('book_img');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('/admin/uploads/book_img'), $fileName);
            
            }

            $currentimage = $book->book_img;

            $data = $request->all();
            $data['book_img'] = ($fileName) ? $fileName : $currentimage;
            $book->update($data);

            if($fileName){
                File::delete(public_path(). '/admin/uploads/book_img/' . $currentimage);
            }

            return redirect()->route('book.index')->with('success', 'Book updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        File::delete('./admin/uploads/book_img/' . $book->book_img);
        
        $book->delete();

         return redirect()->back();
    }
}
