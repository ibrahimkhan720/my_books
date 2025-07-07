<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Validator;
use File;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchTerm = request()->get('q');
        $users = User::latest()->with('role')->where('name' , 'like' , "%$searchTerm%")->paginate(15);
       return view('admin.user.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = validator::make($request->all(),[
            'name' => 'required',
            'designation' => 'required',
            'bio' => 'required',
             'role_id' => 'required',
             'email' => 'required|unique:users,email',
              'password' => 'required',
              'password_confirmation' => 'required',
             
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
             $fileName = null;
            if($request->hasfile('user_image')){
                $file = $request->file('user_image');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path() . '/admin/uploads/user_image', $fileName);

            }
          User::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'bio' => $request->bio,
                'role_id' => $request->role_id,
                 'user_image' => $fileName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
          ]);
          return redirect()->route('user.index')->with('success' , 'user create successfully');
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
        
         $roles = Role::all();
        $user = user::find($id);
        return view('admin.user.edit' , compact('user' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validator = validator::make($request->all(),[
            'name' => 'required',
            'designation' => 'required',
            'bio' => 'required',
             'role_id' => 'required',
             'email' => 'required',
             
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
             $fileName = null;
            if($request->hasfile('user_image')){
                $file = $request->file('user_image');
                $fileName = md5($file->getClientOriginalName()) . "_" . time() . "_" . date('y,m,d') . "." . $file->getClientOriginalExtension();
                $file->move(public_path() . '/admin/uploads/user_image', $fileName);
            }
        $user = user::find($id);
        $currentimage = $user->user_image;
        $user->update([
                 'name' => $request->name,
                'designation' => $request->designation,
                'bio' => $request->bio,
                'role_id' => $request->role_id,
                 'user_image' => ($fileName)? $fileName : $currentimage,
                'email' => $request->email,
        ]);

        if($fileName){
            File::delete(public_path('/admin/uploads/user_image/' . $currentimage));
        }
        return redirect()->route('user.index')->with('success' , 'user update successfully');
    }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = user::find($id);
        $currentimage = $user->user_image;

            File::delete(public_path('/admin/uploads/user_image/' . $currentimage));
        $user->delete();

        return redirect()->back()->with('success' , 'user delete successfully');

    }
}
