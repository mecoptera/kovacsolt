@extends('layouts.panel')

@section('title', 'Base Products')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Edit zone</h1>
  <a href="{{ route('panel.zones') }}" class="btn btn-primary">Back to zones</a>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.zones.update', $zone ? [ 'id' => $zone->id ] : null) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $zone ? $zone->name : '' }}">
          </div>

          <div class="form-group">
            <label for="view_id">View to attach:</label>
            <select class="custom-select" name="view_id" id="view_id">
              @foreach($views as $view)
                <option value="{{ $view->id }}" data-alias="{{ $view->alias }}" {{ $zone && $zone->view_id === $view->id ? 'selected' : '' }}>{{ $view->alias }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="zone_width">Width:</label>
            <input type="number" step="any" name="width" id="width" placeholder="Zone width" class="form-control" value="{{ $zone ? $zone->width : 0 }}">
          </div>

          <div class="form-group">
            <label for="width">Height:</label>
            <input type="number" name="height" id="height" placeholder="Zone height" class="form-control" value="{{ $zone ? $zone->height : 0 }}">
          </div>

          <div class="form-group">
            <label for="width">Left:</label>
            <input type="number" name="left" id="left" placeholder="Zone left" class="form-control" value="{{ $zone ? $zone->left : 0 }}">
          </div>

          <div class="form-group">
            <label for="width">Top:</label>
            <input type="number" name="top" id="top" placeholder="Zone top" class="form-control" value="{{ $zone ? $zone->top : 0 }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="form-group">
          <label for="zone-image-select">Zone background:</label>
          <select class="custom-select" id="zone-image-select">
            @foreach($baseProductViews as $baseProductView)
              <option value="{{ url($baseProductView->getFirstMediaUrl('base_product_view', 'planner')) }}">{{ $baseProductView->view->alias }} | {{ $baseProductView->base_product_color->name }}</option>
            @endforeach
          </select>
        </div>

        <div id="zone-image" style="position: relative; width: 100%; padding-bottom: 100%; background-color: #f8f9fc; background-position: center; background-repeat: no-repeat; background-size: contain;">
          <div id="zone" style="position: absolute; outline: 2px dashed #333;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const nameInputElement = document.querySelector('#name');
  const viewIdSelectElement = document.querySelector('#view_id');
  const widthInputElement = document.querySelector('#width');
  const heightInputElement = document.querySelector('#height');
  const leftInputElement = document.querySelector('#left');
  const topInputElement = document.querySelector('#top');
  const zoneElement = document.querySelector('#zone');
  const zoneImageElement = document.querySelector('#zone-image');

  document.querySelector('#zone-image-select').addEventListener('change', event => {
    zoneImageElement.style.backgroundImage = `url(${event.target.value})`;
  });
  zoneImageElement.style.backgroundImage = `url(${document.querySelector('#zone-image-select').value})`;

  widthInputElement.addEventListener('change', event => {
    zoneElement.style.width = widthInputElement.value + '%';
  });
  heightInputElement.addEventListener('change', event => {
    zoneElement.style.height = heightInputElement.value + '%';
  });
  leftInputElement.addEventListener('change', event => {
    zoneElement.style.left = leftInputElement.value + '%';
  });
  topInputElement.addEventListener('change', event => {
    zoneElement.style.top = topInputElement.value + '%';
  });
  zoneElement.style.width = widthInputElement.value + '%';
  zoneElement.style.height = heightInputElement.value + '%';
  zoneElement.style.left = leftInputElement.value + '%';
  zoneElement.style.top = topInputElement.value + '%';

  if ({{ $zone ? 'false' : 'true' }}) {
    viewIdSelectElement.addEventListener('change', () => {
      nameInputElement.value = viewIdSelectElement.querySelector('option[value="'+viewIdSelectElement.value+'"]').dataset.alias;
    });
    nameInputElement.value = viewIdSelectElement.querySelector('option[value="'+viewIdSelectElement.value+'"]').dataset.alias;
  }
</script>
@endsection
