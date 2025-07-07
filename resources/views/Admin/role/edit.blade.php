@extends('Admin.layouts.master')

@section('title')
{{ 'Edit Role' }}
@endsection


@section('main-content')


<section class="content">
    <form action="{{ route('role.update' , $roles->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Role Name -->
                        <div class="form-group @error ('name') has-error @enderror">
                            <label for="name">Role Name <span class="text text-red">*</span></label>
                            <input type="text" name="name"  class="form-control" id="name" placeholder="Role Name" value="{{ $roles->name }}" >
                        @error('name')
                        <div class="text-alert">{{ $message }}</div>
                        @enderror
                        </div>

                        <!-- Permissions Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>View</th>
                                        <th>Create</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            @foreach ($modules as $module)
                                            <input type="hidden" name="module_id[{{ $module->id }}]" value="{{ $module->id }}">
                                                
                                            <td>{{ $module->name }}</td>
                                            <td>
                                                    @php
                                                            $checked = isset( $rolepermissions[$module->id]) && $rolepermissions[$module->id]->pview == 1;
                                                    @endphp
                                                        
                                                <input type="checkbox" name="permissions[{{ $module->id }}][pview]" value="1" {{ ($checked)? 'checked' : null }} >
                                            </td>
                                            <td>

                                                @php
                                                        $checked = isset($rolepermissions[$module->id]) && $rolepermissions[$module->id]->pcreate == 1;
                                                @endphp

                                                <input type="checkbox" name="permissions[{{ $module->id }}][pcreate]" value="1" {{ ($checked) ? 'checked' : null ; }}>
                                            </td>
                                            <td>

                                                @php
                                                   $checked = isset($rolepermissions[$module->id]) && $rolepermissions[$module->id]->pedit == 1;
                                                @endphp

                                                <input type="checkbox" name="permissions[{{ $module->id }}][pedit]" value="1" {{ ($checked) ? 'checked' : null }} >  
                                            </td>                                      
                                            <td>

                                                @php
                                                    isset($rolepermissions[$module->id]) && $rolepermissions[$module->id]->pdelete == 1;
                                                @endphp

                                                <input type="checkbox" name="permissions[{{ $module->id }}][pdelete]" value="1" {{ ($checked) ? 'checked' : null }}>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </form>
</section>
@endsection