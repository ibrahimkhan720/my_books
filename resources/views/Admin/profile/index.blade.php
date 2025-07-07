@extends('Admin.layouts.master')

@section('page-title')
  User Profile
@endsection

@section('main-content')
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('/admin/uploads/user_image/' . Auth::user()->user_image ) }}" width="128" height="128" alt="{{ Auth::user()->name }}">
          <h3 class="profile-username text-center">{{ Auth()->user()->name }}</h3>
          <p class="text-muted text-center">{{ Auth()->user()->designation }}</p>
        </div>
      </div>

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <div class="box-body">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Edit your Profile</button>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="{{ $errors->has('update.password') || $errors->has('current_password') || $errors->has('new_password') ? '' : 'active' }}">
            <a href="#activity" data-toggle="tab">Bio</a>
          </li>
          <li class="{{ $errors->has('update.password') || $errors->has('current_password') || $errors->has('new_password') ? 'active' : '' }}">
            <a href="#settings" data-toggle="tab">Change Password</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="{{ $errors->has('update.password') || $errors->has('current_password') || $errors->has('new_password') ? '' : 'active' }} tab-pane" id="activity">
            <div class="post">
              <p>{{ Auth()->user()->bio }}</p>
            </div>
          </div>

          <div class="{{ $errors->has('update.password') || $errors->has('current_password') || $errors->has('new_password') ? 'active' : '' }} tab-pane" id="settings">
            <form method="post" action="{{ route('profile.store') }}" class="form-horizontal">
              @csrf
              <div class="form-group @error('current_password') has-error @enderror">
                <label for="current_password" class="col-sm-2 control-label">Old Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Old Password">
                  @error('current_password')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group @error('new_password') has-error @enderror">
                <label for="new_password" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                  @error('new_password')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group @error('new_password_confirmation') has-error @enderror">
                <label for="new_password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm Password">
                  @error('new_password_confirmation')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Change Password</button>
                </div>
              </div>
            </form>
          </div> <!-- /.tab-pane -->
        </div> <!-- /.tab-content -->
      </div> <!-- /.nav-tabs-custom -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
</section>

<!-- Modal for profile update -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Auth()->user()->name }}</h4>
      </div>
      <div class="modal-body">
        <form name="profileForm" id="profileForm" method="post" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
          @csrf
          @method('put') 
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ Auth()->user()->name }}">
            </div>
          </div>
          <div class="form-group">
            <label for="designation" class="col-sm-2 control-label">Designation</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="{{ Auth()->user()->designation }}">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" value="{{ Auth()->user()->email }}" onfocus="this.blur()" />

            </div>
          </div>
          <div class="form-group">
            <label for="bio" class="col-sm-2 control-label">Bio</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="bio" id="bio" rows="6" placeholder="Enter ...">{{ Auth()->user()->bio }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="user_img" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <input type="file" id="user_img" name="user_img">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
