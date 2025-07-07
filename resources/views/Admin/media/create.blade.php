@extends('Admin.layouts.master')

@section('title')
{{ 'Create Media' }}
@endsection

@section('main-content')
<section class="content">


  <!-- Main content -->
  <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12">

            <div class="form-group @error('title') has-error @enderror">
              <label for="title">Title <span class="text text-red">*</span></label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}">
              @error('title')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group @error('slug') has-error @enderror">
              <label for="slug">Slug <span class="text text-red">*</span></label>
              <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug') }}">
              @error('slug')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group @error('media_type') has-error @enderror">
              <label>Media Type <span class="text text-red">*</span></label>
              <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
                <option value="none">-- Select Media Type --</option>
                <option value="slider" {{ old('media_type') == 'slider' ? 'selected' : '' }}>Slider</option>
                <option value="gallery" {{ old('media_type') == 'gallery' ? 'selected' : '' }}>Gallery</option>
              </select>
              @error('media_type')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group @error('media_img') has-error @enderror">
              <label for="media_img">Media Image <span class="text text-red">*</span></label>
              <input type="file" name="media_img" class="form-control" id="media_img">
              @error('media_img')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group @error('description') has-error @enderror">
              <label>Description</label>
              <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description') }}</textarea>
              @error('description')
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
    </div>
  </form>

</section>
@endsection
