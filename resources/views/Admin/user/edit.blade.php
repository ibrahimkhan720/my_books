@extends('Admin.layouts.master')

@section('title')
{{ 'create User' }}
@endsection


@section('main-content')
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
          <form method="post" enctype="multipart/form-data" action="{{ route('user.update' , $user->id) }}">
            @csrf
            @method('put')
              <div class="row">
                <div class="col-xs-12">
                    <div class="form-group @error ('name') has-error @enderror">
                        <label for="name">Name <span class="text text-red">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="{{ $user->name }}">
                   
                   @error('name')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>

                    <div class="form-group @error ('designation') has-error @enderror" >
                        <label for="designation">Designation <span class="text text-red">*</span></label>
                        <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation"  value="{{ $user->designation }}">
                   @error('designation')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>

                    <div class="form-group @error ('bio') has-error @enderror" >
                        <label for="bio">Bio <span class="text text-red">*</span></label>
                        <textarea name="bio" class="form-control" id="bio" rows="4" placeholder="Short Bio">{{ $user->bio }}"</textarea>
                    @error('bio')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    
                    <div class="form-group @error ('role_id') has-error @enderror" >
                        <label for="role_id">Role <span class="text text-red">*</span></label>
                        <select name="role_id" class="form-control" id="role_id">
                            @foreach ($roles as $role)                              
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        @error('role_id')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                        </select>
                    </div>
                    

                    <div class="form-group @error ('email') has-error @enderror" >
                        <label for="email">Email <span class="text text-red">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ $user->email }}">
                    @error('email')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>

                    <div class="form-group @error ('user_image') has-error @enderror" >
                        <label for="user_image">User Image <span class="text text-red">*</span></label>
                        <input type="file" name="user_image" class="form-control" id="user_image" value="{{ $user->user_image }}">
                     @error('user_image')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>

                </div>
            </div>
          
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
        </form>
    </div>
</section>
@endsection
