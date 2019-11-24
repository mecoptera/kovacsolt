@extends('layouts.panel')

@section('title', 'Designed Product Edit')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Edit product variant</h1>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.productvariants.update', [ 'id' => $productVariant->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="width">Width:</label>
            <input type="number" step="any" name="width" id="width" placeholder="Design width" class="form-control" value="{{ $productVariant->design_width }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="left">Left:</label>
            <input type="number" name="left" id="left" placeholder="Design left" class="form-control" value="{{ $productVariant->design_left }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="top">Top:</label>
            <input type="number" name="top" id="top" placeholder="Design top" class="form-control" value="{{ $productVariant->design_top }}" max="100" min="0">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div style="position: relative; padding-bottom: 100%; width: 100%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ url($productVariant->base_product_variant->getFirstMediaUrl('base_product_variant', 'thumb')) }}')">
          <div style="position: absolute; width: {{ $productVariant->base_product_variant->base_product_zone->width }}%; height: {{ $productVariant->base_product_variant->base_product_zone->height }}%; left: {{ $productVariant->base_product_variant->base_product_zone->left }}%; top: {{ $productVariant->base_product_variant->base_product_zone->top }}%;">
            <img id="design" src="{{ url($productVariant->design_image['planner']) }}" style="position: absolute; width: {{ $productVariant->design_width }}%; left: {{ $productVariant->design_left }}%; top: {{ $productVariant->design_top }}%;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
<script>
  const designElement = document.querySelector('#design');
  const widthInputElement = document.querySelector('#width');
  const leftInputElement = document.querySelector('#left');
  const topInputElement = document.querySelector('#top');

  widthInputElement.addEventListener('change', event => {
    designElement.style.width = widthInputElement.value + '%';
  });
  leftInputElement.addEventListener('change', event => {
    designElement.style.left = leftInputElement.value + '%';
  });
  topInputElement.addEventListener('change', event => {
    designElement.style.top = topInputElement.value + '%';
  });

  designElement.style.width = widthInputElement.value + '%';
  designElement.style.left = leftInputElement.value + '%';
  designElement.style.top = topInputElement.value + '%';
</script>
@endsection
