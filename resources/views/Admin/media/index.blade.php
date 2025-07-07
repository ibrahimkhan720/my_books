
@extends('Admin.layouts.master')

@section('title')
{{ 'My Book' }}
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
                  <a class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
            <div class="box-tools">
             <form method="GET" action="{{ route('media.index') }}">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="q" class="form-control pull-right" placeholder="Search" value="{{ (request()->get('q'))? request()->get('q') : null  }}">

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
                  <th width="20%">Media Type</th>
                  <th width="20%">Meida Image</th>
                  <th width="10%">Status</th>
                  <th width="10%">Manage</th>
                </tr>
              </thead>
              <tr>
                @foreach ($medias as $media)
                <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                <td>{{ $media->title }}</td>
                <td>{{ $media->media_type }}</td>
                <td>
                  @if($media->media_img !=null && $media->media_img !='no found image')
                  <img src="{{ asset('/admin/uploads/media_img/' . $media->media_img) }}" alt="{{ $media->title }}" width="100"> 
                  @else
                  {{ 'no found image' }}
                  @endif
                </td>
                <td>
                  @if($media->status == 0 )
                  <a href="{{ route('media.status' , $media->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                 @else
                  <a href="{{ route('media.status' , $media->id) }}" class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></a>
               @endif
                </td>
                <td style="display: flex">
                    <a href="{{ route('media.edit' , $media->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                    <form method="post" enctype="multipart/form-data" action="{{ route('media.destroy' , $media->id) }}">
                      @csrf
                      @method('delete')
                    <button class="btn btn-danger btn-flat btn-sm" onclick="return confirm('are you sure you delete this')"> <i class="fa fa-trash-o"></i></button>
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
                                  Showing {{ ($medias->currentpage()-1)*$medias->perpage()+1 }} to {{ $medias->currentpage()*$medias->perpage() }} of {{ $medias->total() }} entries</span>
                          </div>
                        <div class="col-sm-6 text-right">
                           {{ $medias->links() }}
                  </div>
                      </div>
                  </div>
        </div>
          <!-- /.box-body -->
        </div>


  </section>
@endsection