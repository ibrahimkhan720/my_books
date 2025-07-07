
@extends('Admin.layouts.master')

@section('title')
{{ 'create category' }}
@endsection

@section('main-content')
<section class="content">

    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <!-- row start -->
        <div class="row"> 
              <div class="col-xs-6">
                
                <div class="form-group @error('title') has-error @enderror">
                  <label for="title">Title <span class="text text-red">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}">
                 @error('title')
                 <div class="text-danger">{{ $message }}</div>
                @enderror  
                </div>

                  <div class="form-group @error ('slug') has-error @enderror ">
                  <label for="slug">Slug <span class="text text-red">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug') }}">
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                   @enderror  
                  </div>
                  <div class="form-group @error ('description') has-error @enderror">
                  <label>Description</label>
                  <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description') }}</textarea>
                  @error('description')
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
    <!-- /.box -->
  </form>
    <!-- form end -->

  </section>
@endsection