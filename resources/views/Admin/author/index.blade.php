
@extends('Admin.layouts.master')

@section('title')
{{ 'My Books' }}
@endsection

@section('main-content')
<section class="content">

 @if(session('success'))
 <div class="alert alert-success">
{{ session('success') }}    
</div> 
@endif
    
    <!-- /.row -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                <a href="{{ route('author.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
            <div class="box-tools">
                <form method="get" action="{{ route('author.index') }}">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="search" name="q" class="form-control pull-right" placeholder="Search" value="{{request()->get('q')}}">
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
                        <th width="20%">Title</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Countory</th>
                        <th width="20%">Author Image</th>
                        <th width="10%">Status</th>
                        <th width="10%">Manage</th>
                    </tr>
                </thead>
                <tr>
                    @foreach ($authors as $author)                  
                    <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                    <td>{{ $author->title }}</td>
                    <td>{{ $author->designation }}</td>
                    <td>{{ $author->country }}</td>
                    <td>
                        @if($author->author_img && $author->author_img !== 'no found image')
                        <img src="{{ asset('admin/uploads/author_img/' . $author->author_img) }}" alt="{{ $author->title }}" width="100">
                    @else
                        <p>No image found</p>
                    @endif
                    
                    </td>
                    <td>
                        @if($author->status==0)
                           <a href="{{ route('author.status' , $author->id) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                        @else
                        <a href="{{ route('author.status' , $author->id) }}"><button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button></a>
                        @endif
                    </td>
                    <td style="display: flex">
                        <a href="{{ route('author.edit' , $author->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>

                       <form method="post" enctype="multipart/form-data" action="{{ route('author.destroy' , $author->id) }}">
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
                        Showing {{ ($authors->currentPage()-1)*$authors->perPage()+1 }} to {{ $authors->currentPage()*$authors->perPage() }}
                        of {{ $authors->total() }} entries
                    </span>
                </div>
                <div class="col-sm-6 text-right">
                    <ul class="pagination custom-pagination">
                        {{ $authors->links() }}
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.box-body -->
</div>
</section>
@endsection