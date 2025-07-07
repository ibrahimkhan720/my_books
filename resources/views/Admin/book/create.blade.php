
@extends('Admin.layouts.master')

@section('title')
{{ 'Create Books' }}
@endsection

@section('main-content')
<section class="content">

    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <!-- row start -->
     <div class="row"> 
    <div class="col-xs-6">
        
        <div class="form-group @error('title') has-error @enderror">
            <label for="title">Title <span class="text text-red">*</span></label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" >
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('slug') has-error @enderror">
            <label for="slug">Slug <span class="text text-red">*</span></label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
            @error('slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('category_id') has-error @enderror">
            <label>Category <span class="text text-red">*</span></label>
            <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>     
                @endforeach
               
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('author_id') has-error @enderror">
            <label>Author <span class="text text-red">*</span></label>
            <select class="form-control" name="author_id" id="author_id" style="width: 100%;">
                @foreach ($authores as $authore)
                <option value="{{ $authore->id }}">{{ $authore->title }}</option>     
                @endforeach
            </select>
            @error('author_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('availability') has-error @enderror">
            <label for="availability">Availability <span class="text text-red">*</span></label>
            <select name="availability" id="availability" class="form-control">
                <option value="none">-- Select Availability --</option>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
            @error('availability')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('price') has-error @enderror">
            <label for="price">Price: <span class="text text-red">*</span></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
         <div class="form-group @error('rating') has-error @enderror">
            <label for="rating">Rating: <span class="text text-red">*</span></label>
            <input type="text" class="form-control" name="rating" id="rating" placeholder="rating">
            @error('rating')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('publisher') has-error @enderror">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
            @error('publisher')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('country_of_publisher') has-error @enderror">
            <label>Country of Publisher <span class="text text-red">*</span></label>
            <select class="form-control select2" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                <option value="none"> -- Select Country -- </option>
                    @foreach ($countories as $countory)    
                        <option value="{{ $countory->name }}">{{ $countory->name  }}</option>
                    @endforeach
            </select>
            @error('country_of_publisher')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
         <div class="form-group @error('status') has-error @enderror">
            <label>Status <span class="text text-red">*</span></label>
            <select class="form-control select2" name="status" id="status" style="width: 100%;">
                  <option value="0"> none </option>     
                <option value="3"> upcoming </option>          
            </select>
        </div>

        <div class="form-group @error('isbn') has-error @enderror">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
            @error('isbn')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('isbn_10') has-error @enderror">
            <label for="isbn_10">ISBN-10</label>
            <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10">
            @error('isbn_10')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group @error('book_img') has-error @enderror">
            <label for="book_img">Book Image</label>
            <input type="file" class="form-control" name="book_img" id="book_img">
            <small class="label label-warning">Cover Photo will be uploaded</small>
            @error('book_img')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('book_upload') has-error @enderror">
            <label for="book_upload">Book Upload</label>
            <input type="file" class="form-control" name="book_upload" id="book_upload">
            <small class="label label-warning">Book (PDF) will be uploaded</small>
            @error('book_upload')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('audience') has-error @enderror">
            <label for="audience">Audience</label>
            <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience">
            @error('audience')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('downloaded') has-error @enderror">
            <label for="downloaded">Downloaded</label>
            <input type="text" class="form-control" name="downloaded" id="downloaded" placeholder="downloaded">
            @error('downloaded')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('format') has-error @enderror">
            <label for="format">Format</label>
            <input type="text" class="form-control" name="format" id="format" placeholder="Format">
            @error('format')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('language') has-error @enderror">
            <label for="language">Language</label>
            <input type="text" class="form-control" name="language" id="language" placeholder="Language">
            @error('language')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('total_pages') has-error @enderror">
            <label for="total_pages">Total Pages</label>
            <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages">
            @error('total_pages')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('edition_number') has-error @enderror">
            <label for="edition_number">Edition Number</label>
            <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number">
            @error('edition_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('recommended') has-error @enderror">
            <label>Recommended</label>
            <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
                <option value="none">-- Select Recommended --</option>
                <option value="yes">Recommended</option>
                <option value="no">Not Recommended</option>
            </select>
            @error('recommended')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group @error('description') has-error @enderror">
            <label for="description">Description <span class="text text-red">*</span></label>
            <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
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