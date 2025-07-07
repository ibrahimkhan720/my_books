<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Validator;
use File;

class MediaController extends Controller
{
    public function index()
    {
        $searchTerm = request()->get('q');
        $medias = Media::latest()->where('title', 'like', "%$searchTerm%")->paginate(15);
        return view('admin.media.index', compact('medias'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'media_type' => 'required|not_in:none',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $fileName = null;
            if ($request->hasfile('media_img')) {
                $file = $request->file('media_img');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('/admin/uploads/media_img'), $fileName);
            }

            Media::create([
                'media_img' => $fileName,
                'media_type' => $request->media_type,
                'slug' => $request->slug,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('media.index')->with('success', 'media create successfully');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $media = Media::find($id);
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'media_type' => 'required|not_in:none',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $fileName = null;
            if ($request->hasfile('media_img')) {
                $file = $request->file('media_img');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('/admin/uploads/media_img'), $fileName);
            }

            $media = Media::find($id);
            $currentimage = $media->media_img;
            $media->update([
                'media_img' => ($fileName) ? $fileName : $currentimage,
                'media_type' => $request->media_type,
                'slug' => $request->slug,
                'title' => $request->title,
                'description' => $request->description
            ]);

            if ($fileName) {
                File::delete(public_path('/admin/uploads/media_img/' . $currentimage));
            }

            return redirect()->route('media.index')->with('success', 'media update successfully');
        }
    }

    public function destroy(string $id)
    {
        $media = media::find($id);
        $currentimage = $media->media_img;
        File::delete(public_path('/admin/uploads/media_img/' . $currentimage));

        $media->delete();

        return redirect()->back()->with('success' , 'media delete successfully');
    }
}
