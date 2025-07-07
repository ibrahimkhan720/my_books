<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Role;
use App\Models\Module;
use App\Models\Rolepermission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('Admin.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::orderBy( 'id' , 'DESC')->get();
         return view('Admin.role.create' , compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
           $role =  Role::create([
                'name' => $request->name,
            ]);

        if($request->has('permissions')){
            foreach($request->permissions as $module_id => $perm){
              Rolepermission::create([
                  'role_id' => $role->id ,
                   'module_id' => $module_id,
                   'pview' => isset($perm['pview'])? 1 : 0,
                   'pcreate' => isset($perm['pcreate'])? 1: 0,
                   'pedit' => isset($perm['pedit'])? 1: 0,
                   'pdelete' => isset($perm['pdelete'])? 1: 0,

              ]);

            }
              return redirect()->route('role.index');
        };
        
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
        $roles = Role::find($id);
        $rolepermissions = Rolepermission::where('role_id' , $id)->get()->keyBy('module_id');
        $modules = Module::orderBy('id' , 'DESC')->get();
        return view('admin.role.edit' , compact('roles' , 'rolepermissions' , 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            $roles = Role::find($id);
            $roles->update([
                'name' => $request->name,
            ]);

            Rolepermission::where('role_id' , $id)->delete();

            if($request->has('permissions')){
                foreach($request->permissions as $module_id => $perm){
                    Rolepermission::create([
                        'role_id' => $roles->id,
                        'module_id' => $module_id,
                        'pview' => isset($perm['pview'])? 1 : 0,
                        'pcreate' => isset($perm['pcreate'])? 1 : 0,
                        'pedit' => isset($perm['pedit'])? 1 : 0,
                        'pdelete' => isset($perm['pdelete'])? 1 : 0,
                    ]);
                }

                return redirect()->route('role.index')->with('success' , 'role update successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
