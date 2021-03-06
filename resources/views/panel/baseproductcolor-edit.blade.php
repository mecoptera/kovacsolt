@extends('layouts.panel')

@section('title', 'Base Product Color')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Edit product color</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproductcolors.update', [ 'id' => $baseProductColor->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $baseProductColor->name }}">
          </div>
          <div class="form-group">
            <label for="value">Value:</label>
            <input type="color" name="value" id="value" placeholder="Value" class="form-control" style="width: 128px;" value="{{ $baseProductColor->value }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>
@endsection
