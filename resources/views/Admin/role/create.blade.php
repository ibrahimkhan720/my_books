@extends('Admin.layouts.master')

@section('title')
{{ 'create Role' }}
@endsection


@section('main-content')


<section class="content">
    <form action="{{ route('role.store') }}" method="POST" >
        @csrf
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Role Name --> 
                        <div class="form-group @error ('name') has-error @enderror">
                            <label for="name">Role Name <span class="text text-red">*</span></label>
                            <input type="text" name="name"  class="form-control" id="name" placeholder="Role Name" >
                       @error('name')
                       <div class="text-danger">{{ $message }}</div>
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
                                        @foreach($modules as $module)
                                        <tr>
                                            <td>{{ $module->name }}</td>
                                            <td>
                                                <label class="custom-switch pl-0">
                                                    <input type="checkbox" name="permissions[{{ $module->id }}][pview]" value="1" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                                
                                            </td>
                                            <td>
                                                <label class="custom-switch pl-0">
                                                    <input type="checkbox" name="permissions[{{ $module->id }}][pcreate]" value="1" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch pl-0">
                                                    <input type="checkbox" name="permissions[{{ $module->id }}][pedit]" value="1" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-switch pl-0">
                                                    <input type="checkbox" name="permissions[{{ $module->id }}][pdelete]" value="1" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
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
                <button type="submit" class="btn btn-primary">create</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </form>
</section>
@endsection