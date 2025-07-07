@extends('Admin.layouts.master')

@section('title')
{{ 'create Team' }}
@endsection

@section('main-content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
   <form method="post" enctype="multipart/form-data" action="{{ route('team.index') }}">
    @csrf
     <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- row start -->
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group @error ('fullname') has-error @enderror">
                        <label for="fullname">Fullname <span class="text text-red">*</span></label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Fullname">
                   @error('fullname')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error ('fullname') has-error @enderror">
                        <label for="designation">Designation <span class="text text-red">*</span></label>
                        <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation">
                     @error('desgination')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('telephone') has-error @enderror">
                        <label for="telephone">Telephone</label>
                        <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone">
                      @error('telephone')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('mobile') has-error @enderror">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile">
                   @error('telephone')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('email') has-error @enderror">
                        <label for="email">Email <span class="text text-red">*</span></label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                    @error('telephone')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="team_img">Team Image <span class="text text-red">*</span></label>
                        <input type="file" name="team_img" class="form-control" id="team_img">
                    
                    </div>
                    <div class="form-group @error('facebook_id') has-error @enderror">
                        <label for="facebook_id">Facebook ID <span class="text text-red">*</span></label>
                        <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID">
                    @error('facebook_id')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('twitter_id') has-error @enderror">
                        <label for="twitter_id">Twitter ID <span class="text text-red">*</span></label>
                        <input type="text" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID">
                   @error('twitter_id')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    <div class="form-group @error('pinterest_id') has-error @enderror">
                        <label for="pinterest_id">Pinterest ID <span class="text text-red">*</span></label>
                        <input type="text" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
                    @error('pinterest_id')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror
                    </div>
                    
                </div>
            </div>
            <!-- row end -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
    </div>
   </form>
    <!-- /.box -->
    <!-- form end -->
</section>
@endsection