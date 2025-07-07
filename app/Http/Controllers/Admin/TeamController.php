<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Validator;
use File;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchTerm = request()->get('q');
        $teams = Team::latest()->Where('fullname' , 'like' , "%$searchTerm%")->paginate(15);
        return view('admin.team.index' , compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fullname' => 'required',
            'designation' => 'required',
            'telephone' => 'required',
            'mobile' => 'required',
            'email' => 'required|unique:teams,email',
             'description' => 'required',
            'facebook_id' => 'required',
            'twitter_id' => 'required',
            'pinterest_id' => 'required',
  
        ]);

        if($validator->Fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $fileName = null;
            if($request->hasfile('team_img')){
                $file = $request->file('team_img');
                $fileName = md5($file->getClientOriginalName()) . '_' . time() . '_' . date('y,m,d') . '.' . $file->getclientoriginalExtension();
                $file->move(public_path('admin/uploads/team_img'), $fileName);
            }

            Team::create([
                'fullname' => $request->fullname,
                'designation' => $request->designation,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'description' => $request->description,
                'facebook_id' => $request->facebook_id,
                'twitter_id' => $request->twitter_id,
                'pinterest_id' => $request->pinterest_id,
                'team_img' => $fileName,
            ]);

            return redirect()->route('team.index')->with('success' , 'team create successfully');
        
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
        $team = team::find($id);
        return view('admin.team.edit'  , compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = validator::make($request->all(),[
            'fullname' => 'required',
            'designation' => 'required',
            'telephone' => 'required',
            'mobile' => 'required',
            'email' => 'required',
             'description' => 'required',
            'facebook_id' => 'required',
            'twitter_id' => 'required',
            'pinterest_id' => 'required',
  
        ]);

        if($validator->Fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
             $fileName = null;
            if($request->hasfile('team_img')){
                $file = $request->file('team_img');
                $fileName = md5($file->getClientOriginalName()) . '_' . time() . '_' . date('y,m,d') . '.' . $file->getclientoriginalExtension();
                $file->move(public_path('admin/uploads/team_img'), $fileName);
            }

        $team = team::find($id);
        $currentimage = $team->team_img;
        $team->update([
            'fullname' => $request->fullname,
                'designation' => $request->designation,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'description' => $request->description,
                'facebook_id' => $request->facebook_id,
                'twitter_id' => $request->twitter_id,
                'pinterest_id' => $request->pinterest_id,
                'team_img' => ($fileName) ? $fileName : $currentimage,
        ]);

        if($fileName){
            File::delete(public_path('/admin/uploads/team_img/' . $currentimage));
        }
            return redirect()->route('team.index')->with('success' , 'team update successfully');

    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = team::find($id);
        $currentimage = $team->team_img;
       File::delete(public_path('/admin/uploads/team_img/') . $currentimage);

        $team->delete();

        return redirect()->back()->with('success' , 'team delete successfully');
    }
}
