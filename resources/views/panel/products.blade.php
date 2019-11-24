@extends('layouts.panel')

@section('title', 'Designed Products')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Create product</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.products.create') }}">
          @csrf

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Name" class="form-control">
          </div>

          <div class="form-group">
            <label for="base_product">Base product:</label>
            <select class="custom-select" id="base_product" name="base_product">
              @foreach($baseProducts as $baseProduct)
                <option value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</option>
              @endforeach
            </select>
          </div>

          <input type="submit" class="btn btn-primary" value="Create">
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
            <th>Updated</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->updated_at }}</td>
              <td>
                <a href="{{ route('panel.products.edit', $product->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                <a href="{{ route('panel.products.delete', $product->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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
        targets: 2,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
