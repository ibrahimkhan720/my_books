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
                <a href="#" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <thead style="background-color: #F8F8F8;">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="70%">Role Name</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($roles as $role)
                            
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('role.edit' , $role->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="#" method="POST" style="display:inline-block;">
                                @csrf
                                
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
@endsection
