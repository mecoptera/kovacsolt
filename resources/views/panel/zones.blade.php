@extends('layouts.panel')

@section('title', 'Zones')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">List</h1>
  <a href="{{ route('panel.zones.edit') }}" class="btn btn-primary">Create New</a>
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
          @foreach($zones as $zone)
            <tr>
              <td>{{ $zone->name }}</td>
              <td>{{ $zone->created_at }}</td>
              <td>
                <a href="{{ route('panel.zones.edit', $zone->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                <a href="{{ route('panel.zones.delete', $zone->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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
