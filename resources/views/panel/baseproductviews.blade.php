@extends('layouts.panel')

@section('title', 'Base Product Views')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Upload views</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form id="design-upload-form" method="post" action="{{ route('panel.baseproductviews.upload') }}" enctype="multipart/form-data">
          @csrf
          <input type="file" name="images[]" class="d-none custom-file-input" id="inputGroupFile">

          <div class="input-group">
            <div class="input-group-prepend">
              <label for="inputGroupFile" class="btn btn-outline-primary">Browse</label>
            </div>
            <input type="text" name="name" placeholder="Name" class="form-control form-control-user">
            <select name="base_product_id" class="custom-select">
              @foreach ($baseProducts as $baseProduct)
                <option value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</option>
              @endforeach
            </select>
            <div class="input-group-append">
              <button class="btn btn-primary mb-2">Upload</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="d-sm-flex align-items-center mb-4">
  <h1 class="h3 mb-0 text-gray-800">List views</h1>
</div>

<div class="row">
  @foreach($views as $view)
    @component('panel.components.baseproductview', [ 'view' => $view ]) @endcomponent
  @endforeach
</div>
@endsection
