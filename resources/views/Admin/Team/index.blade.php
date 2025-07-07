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
                <a href="{{ route('team.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
            <div class="box-tools">
                <form method="get" action="{{ route('team.index') }}">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="search" name="q" class="form-control pull-right" placeholder="Search" value="{{ (request()->get('q'))? request()->get('q') : null }}">
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
                        <th width="20%">Fullname</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Team Image</th>
                        <th width="10%">Status</th>
                        <th width="10%">Manage</th>
                    </tr>
                </thead>
                <tr>
                    @foreach ($teams as $team)
                    <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                    <td>{{ $team->fullname }}</td>
                    <td>{{ $team->designation }}</td>
                    <td>
                        @if($team->team_img !=null && $team->team_img !='no found image')
                        <img src="{{ asset('admin/uploads/team_img/' . $team->team_img ) }} " alt="{{ $team->fullname }}" width="100">
                        @else
                        {{ 'no found image' }}
                        @endif
                    </td>
                    <td>
                        @if($team->status == 0)
                       <a href="{{ route('team.status' , $team->id) }}"> <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                       @else
                       <a href="{{ route('team.status' , $team->id) }}"> <button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button></a>
                       @endif

                    </td>
                    <td style="display: flex">
                        <a href="{{ route('team.edit' , $team->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                        <form method="post" enctype="multipart/form-data" action="{{ route('team.destroy' , $team->id) }}">
                            @csrf
                            @method('delete')
                       <button class="btn btn-danger btn-flat btn-sm" onclick=" return confirm('are you sure delete this')"> <i class="fa fa-trash-o"></i></button>
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
                        Showing {{ ($teams->currentpage()-1)*$teams->perpage()+1 }} to {{ $teams->currentpage()*$teams->perpage() }} of {{ $teams->total() }} entries</span>
                </div>
                <div class="col-sm-6 text-right">
                    {{ $teams->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
</section>
@endsection