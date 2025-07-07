
@extends('Admin.layouts.master')

@section('title')
{{ 'My Books' }}
@endsection

@section('main-content')
<section class="content">
      
    <!-- /.row -->
   <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> 
                  <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                  <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                  <a href="{{ route('book.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
            <div class="box-tools">
             <form method="get" action="{{ route('book.index') }}">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="search" name="q" class="form-control pull-right" placeholder="Search" value="{{ (request()->get('q')) ? request()->get('q') : null }}">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
             </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <thead style="background-color: #F8F8F8;">
                <tr>
                  <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                  <th width="25%">Title</th>
                  <th width="15%">Author</th>
                  <th width="15%">Category</th>
                  <th width="15%">Countory</th>
                  <th width="20%">Book Image</th>
                  <th width="10%">Status</th>
                  <th width="10%">Manage</th>
                </tr>
              </thead>
              <tr>
                  @foreach ($books as $book)
                      
                <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author?->title }}</td>
                <td>{{ $book->category?->title }}</td>
                <td>{{ $book->country_of_publisher }}</td>
                <td>
                  @if($book->book_img !=null)
                    <img src="{{ asset('admin/uploads/book_img/' . $book->book_img) }}" alt="{{ $book->title }}" width="100">
                    @else
                    {{ 'no found image' }}
                    @endif
                </td>
                <td>
                  @if($book->status == 0)
                  <a href="{{ route('book.status' , $book->id) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                  @else
                 <a href="{{ route('book.status' , $book->id) }}"> <button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button></a>
                  @endif
                </td>
                <td style="display: flex">
                    <a href="{{ route('book.edit',$book->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                    <form action="{{ route('book.destroy', $book->id) }}" method="post">
                    @csrf
                    @method('delete')
                      <button class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                    </form>
                </td>
              </tr>
              @endforeach
          </table>
          </div>
          <!-- /.box-body -->
            <div class="box-footer clearfix">
                      <div class="row">
                          <div class="col-sm-6">
                              <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                  Showing {{ ($books->currentPage()-1)*$books->perpage()+1 }} to {{ ($books->currentpage())* $books->perpage() }} of {{ $books->total() }} entries</span>
                          </div>
                        <div class="col-sm-6 text-right">
                           {{ $books->links() }}
                        </div>
                      </div>
                  </div>
        </div>
          <!-- /.box-body -->
        </div>


  </section>
  <!-- /.content -->
@endsection