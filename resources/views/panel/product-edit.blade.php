@extends('layouts.panel')

@section('title', 'Designed Product Edit')

@section('head')

@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Edit product</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.products.update', [ 'id' => $product->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $product->name }}">
          </div>

          <div class="form-group">
            <label for="base_product">Base product:</label>
            <select class="custom-select" id="base_product" name="base_product">
              @foreach($baseProducts as $baseProduct)
                <option value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" placeholder="Price" class="form-control" value="{{ $product->price }}">
          </div>

          <div class="form-group">
            <input type="checkbox" name="show_on_welcome" id="show_on_welcome" {{ $product->show_on_welcome ? 'checked' : '' }}>
            <label for="show_on_welcome">Feature on welcome</label>
          </div>

          <div class="form-group">
            <input type="checkbox" name="is_public" id="is_public" {{ $product->is_public ? 'checked' : '' }}>
            <label for="is_public">Public</label>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add variant</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.products.variants.create', [ 'id' => $product->id ]) }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="base_product_variant">Variant:</label>
            <select class="custom-select" id="base_product_variant" name="base_product_variant">
              @foreach($baseProductVariants as $baseProductVariant)
                <option value="{{ $baseProductVariant->id }}">{{ $baseProductVariant->base_product_view->name }} | {{ $baseProductVariant->base_product_color->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="image">Design:</label>
            <div class="row" style="max-height: 350px; overflow: auto;">
              @foreach($designs as $design)
                <div class="col-lg-3 mb-4">
                  <label class="card p-4" style="cursor: pointer;">
                    <input type="radio" name="design" value="{{ $design->id }}" url="{{ url($design->getFirstMediaUrl('design', 'planner')) }}">
                    <div style="background-image: url({{ url($design->getFirstMediaUrl('design', 'thumb')) }}); background-size: contain; background-position: center; background-repeat: no-repeat; width: 100%; padding-bottom: 100%;"></div>
                    <span class="u-uppercase u-font-bold">{{ $design->name }}</span>
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Designs</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableVariants" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Design</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($productVariants as $productVariant)
                <tr>
                  <td>
                    <div style="position: relative; width: 128px; height: 128px; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ url($productVariant->base_product_variant->getFirstMediaUrl('base_product_variant', 'thumb')) }}')">
                      <div style="position: absolute; width: {{ $productVariant->base_product_variant->base_product_zone->width }}%; height: {{ $productVariant->base_product_variant->base_product_zone->height }}%; left: {{ $productVariant->base_product_variant->base_product_zone->left }}%; top: {{ $productVariant->base_product_variant->base_product_zone->top }}%;">
                        <img id="design" src="{{ url($productVariant->design_image['planner']) }}" style="position: absolute; width: {{ $productVariant->design_width }}%; left: {{ $productVariant->design_left }}%; top: {{ $productVariant->design_top }}%;">
                      </div>
                    </div>
                  </td>
                  <td>
                    <div>View: <b>{{ $productVariant->base_product_variant->base_product_view->name }}</b></div>
                    <div>Color: <b>{{ $productVariant->base_product_variant->base_product_color->name }}</b></div>
                    <div>Design: <b>{{ $productVariant->design_name }}</b></div>
                  </td>
                  <td>
                    <a href="{{ route('panel.productvariants.edit', $productVariant->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ route('panel.productvariants.delete', $productVariant->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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

@endsection
