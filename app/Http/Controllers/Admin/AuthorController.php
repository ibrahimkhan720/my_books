<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Countory;
use Validator;
use File;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchTerm = request()->get('q');
        $authors = Author::latest()
            ->where('title', 'like', "%$searchTerm%")
            ->paginate(15);

        return view('Admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countories = Countory::all();
        return view('Admin.author.create',compact('countories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'dob' => 'required|date',
            'email' => 'required|email|unique:authors,email',
            'country' => 'required|not_in:none',
            'phone' => 'required',
            'description' => 'required',
             'author_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_feature' => 'required|not_in:none',
        ], [
            'title.required' => 'Title is required.',
            'slug.required' => 'Slug is required.',
            'designation.required' => 'Designation is required.',
            'dob.required' => 'Date of birth is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email has already been taken',
            'country.required' => 'Please select a country.',
            'country.not_in' => 'Please select a valid country ("None").',
            'phone.required' => 'Phone number is required.',
            'description.required' => 'Description is required.',
             'author_img.required' => 'Author image is required.',
             'author_img.image' => 'Author image must be an image file.',
             'author_img.mimes' => 'Author image must be a jpeg, png, jpg, or gif.',
            'author_feature.required' => 'Featured image is required.',
            'author_feature.not_in' => 'Please select a valid featured image ("None").',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $fileName = null;
            if($request->hasfile('author_img')){
                $file = $request->file('author_img');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path() . '/admin/uploads/author_img', $fileName);

            }

            Author::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'designation' => $request->designation,
                'dob' => $request->dob,
                'email' => $request->email,
                'country' => $request->country,
                'phone' => $request->phone,
                'description' => $request->description,
                'author_img' => $fileName,
                'author_feature' => $request->author_feature,
                'facebook_id' => $request->facebook_id,
                'twitter_id' => $request->twitter_id,
                'youtube_id' => $request->youtube_id,
                'pinterest_id' => $request->pinterest_id,
            ]);
        }

       

        return redirect()->route('author.index')->with('success', 'Author created successfully');
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
        $authers = Author::find($id);
        $countories = Countory::all();
        return view('Admin.author.edit' , compact('authers','countories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'dob' => 'required|date',
            'email' => 'required',
            'country' => 'required|not_in:none',
            'phone' => 'required',
            'description' => 'required',
             'author_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_feature' => 'required|not_in:none',
        ],[
            
            'title.required' => 'Title is required.',
            'slug.required' => 'Slug is required.',
            'designation.required' => 'Designation is required.',
            'dob.required' => 'Date of birth is required.',
            'email.required' => 'Email is required.',
            'country.required' => 'Please select a country.',
            'country.not_in' => 'Please select a valid country ("None").',
            'phone.required' => 'Phone number is required.',
            'description.required' => 'Description is required.',
             'author_img.required' => 'Author image is required.',
             'author_img.image' => 'Author image must be an image file.',
             'author_img.mimes' => 'Author image must be a jpeg, png, jpg, or gif.',
            'author_feature.required' => 'Featured image is required.',
            'author_feature.not_in' => 'Please select a valid featured image ("None").',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $fileName= null;
            if($request->hasfile('author_img')){
              $file = $request->file('author_img');
              $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
              $file->move(public_path() . '/admin/uploads/author_img', $fileName);

            }
            $authers = Author::find($id);
            $currentimage = $authers->author_img;
            $authers->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'designation' => $request->designation,
                'dob' => $request->dob,
                'email' => $request->email,
                'country' => $request->country,
                'phone' => $request->phone,
                'description' => $request->description,
                'author_img' => ($fileName) ? $fileName : $currentimage,
                'author_feature' => $request->author_feature,
                'facebook_id' => $request->facebook_id,
                'twitter_id' => $request->twitter_id,
                'youtube_id' => $request->youtube_id,
                'pinterest_id' => $request->pinterest_id,
            ]);

            if($fileName){
                File::delete(public_path(). '/admin/uploads/author_img/' . $currentimage);
            }
            
            return redirect()->route('author.index')->with('success' , 'author update successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $currentimage = $author->author_img;
        File::delete(public_path('/admin/uploads/author_img/' . $currentimage));
        $author->delete();

        return redirect()->back()->with('success' , 'author delete successfully');
    }
}
