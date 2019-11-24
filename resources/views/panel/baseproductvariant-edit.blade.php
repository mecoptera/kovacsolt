@extends('layouts.panel')

@section('title', 'Base Product View')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Edit product variant</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproductvariants.update', [ 'id' => $baseProductVariant->id ]) }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="view">View:</label>
            <select class="custom-select" id="view" name="view">
              @foreach($baseProductViews as $baseProductView)
                <option value="{{ $baseProductView->id }}" {{ $baseProductView->id === $baseProductVariant->base_product_view_id ? 'selected' : '' }}>
                  {{ $baseProductView->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="color">Color:</label>
            <select class="custom-select" id="color" name="color">
              @foreach($baseProductColors as $baseProductColor)
                <option value="{{ $baseProductColor->id }}" {{ $baseProductColor->id === $baseProductVariant->base_product_color_id ? 'selected' : '' }}>
                  {{ $baseProductColor->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" id="image">
            <div class="mt-4">
              <img src="{{ url($baseProductVariant->getFirstMediaUrl('base_product_variant', 'thumb')) }}" style="width: 100px; height: 100px;">
            </div>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
    </div>
  </div>
@endsection
