@extends('Admin.layouts.master')

@section('title', 'My Books')

@section('main-content')
<section class="content">

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="box">
    <div class="box-header with-border">
     <h3 class="box-title">
                <a id="statusActive" class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                <a href="{{ route('category.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
            </h3>
      <div class="box-tools">
        <form method="get" action="{{ route('category.index') }}">
          <div class="input-group input-group-sm" style="width: 250px;">
            <input type="text" name="q" class="form-control pull-right" placeholder="Search" value="{{ request()->get('q') ?? '' }}">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="box-body">
      <table class="table table-bordered">
        <thead style="background-color: #F8F8F8;">
          <tr>
            <th width="5%">#</th>
            <th>Title</th>
            <th width="10%">Status</th>
            <th width="15%">Manage</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>
              @if($category->status == 0)
              <button class="btn btn-danger btn-sm single-status" data-href="{{ route('category.status', $category->id) }}">
                <i class="fa fa-thumbs-down"></i>
              </button>
              @else
              <button class="btn btn-info btn-sm single-status" data-href="{{ route('category.status', $category->id) }}">
                <i class="fa fa-thumbs-up"></i>
              </button>
              @endif
            </td>
            <td style="display: flex; gap: 5px;">
              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm">
                <i class="fa fa-edit"></i>
              </a>

              <form method="POST" action="{{ route('category.destroy', $category->id) }}" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm single-delete" type="submit">
                  <i class="fa fa-trash-o"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="box-footer clearfix">
      <div class="row">
        <div class="col-sm-6">
          <span>
            Showing {{ ($categories->currentPage() - 1) * $categories->perPage() + 1 }} to
            {{ min($categories->currentPage() * $categories->perPage(), $categories->total()) }} of {{ $categories->total() }} entries
          </span>
        </div>
        <div class="col-sm-6 text-right">
          {{ $categories->links() }}
        </div>
      </div>
    </div>
  </div>

</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

  // Toggle single status button
  $('.single-status').on('click', function(e) {
    e.preventDefault();
    let btn = $(this);
    let url = btn.data('href');
    $.get(url, function(response) {
      if(response == 1) {
        btn.removeClass('btn-danger').addClass('btn-info').html('<i class="fa fa-thumbs-up"></i>');
      } else {
        btn.removeClass('btn-info').addClass('btn-danger').html('<i class="fa fa-thumbs-down"></i>');
      }
    });
  });

  // Delete with confirmation and AJAX
  $('.single-delete').on('click', function(e) {
    e.preventDefault();

    if(!confirm('Are you sure you want to delete this category?')) return;

    let btn = $(this);
    let form = btn.closest('form');
    let url = form.attr('action');
    let row = form.closest('tr');
    let formData = form.serialize();

    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: formData,
      success: function(response) {
        if(response.success) {
          row.css('background-color', '#ffdddd').fadeOut(800, function() {
            $(this).remove();
          });
        } else {
          alert(response.message || 'Delete failed.');
        }
      },
      error: function(xhr) {
        alert('Server error: ' + xhr.status);
      }
    });
  });



});
</script>
@endsection
