@extends('layouts.panel')

@section('title', 'Views')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Create view</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.views.create') }}" class="form-inline">
          @csrf

          <div class="form-group mx-sm-3">
            <input type="text" name="name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group mx-sm-3">
            <input type="text" name="alias" placeholder="Alias" class="form-control">
          </div>
          <input type="submit" class="btn btn-primary" value="Save">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="d-sm-flex align-items-center mb-4">
  <h1 class="h3 mb-0 text-gray-800">List</h1>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Alias</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($views as $view)
            <tr>
              <td>{{ $view->name }}</td>
              <td>{{ $view->alias }}</td>
              <td>{{ $view->created_at }}</td>
              <td>
                <a href="{{ route('panel.views.edit', $view->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                <a href="{{ route('panel.views.delete', $view->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 3,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
