@extends('layouts.panel')

@section('title', 'Base Products')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Edit product</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproducts.update', [ 'id' => $baseProduct->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name in select:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $baseProduct->name }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add color</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproducts.colors.create', [ 'id' => $baseProduct->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name in select:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group">
            <label for="value">Value:</label>
            <input type="color" name="value" id="value" placeholder="Value" class="form-control" style="width: 128px;">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add view</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproducts.views.create', [ 'id' => $baseProduct->id ]) }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="view">View:</label>
            <select class="custom-select" id="view" name="view">
              @foreach($views as $view)
                <option value="{{ $view->id }}">{{ $view->alias }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="color">Color:</label>
            <select class="custom-select" id="color" name="color">
              @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" id="image">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800">Colors</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableColors" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Color</th>
                <th>Name</th>
                <th>Value</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($colors as $color)
                <tr>
                  <td><div style="display: inline-block; width: 32px; height: 32px; background-color: {{ $color->value }}; border: 2px solid #e3e6f0;"></div></td>
                  <td>{{ $color->name }}</td>
                  <td>{{ $color->value }}</td>
                  <td>
                    <a href="{{ route('panel.baseproducts.edit', $baseProduct->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ route('panel.baseproducts.delete', $baseProduct->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800">Views</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableViews" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($baseProductViews as $baseProductView)
                <tr>
                  <td><img src="{{ url($baseProductView->getFirstMediaUrl('base_product_view', 'thumb')) }}" style="width: 100px; height: 100px;"></td>
                  <td>{{ $baseProductView->view->alias }}</td>
                  <td>
                    <a href="{{ route('panel.baseproducts.edit', $baseProduct->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ route('panel.baseproducts.delete', $baseProduct->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTableColors').DataTable({
    columnDefs: [
      {
        targets: 3,
        className: 'dt-body-right'
      }
    ]
  });

  $('#dataTableViews').DataTable({
    columnDefs: [
      {
        targets: 1,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
