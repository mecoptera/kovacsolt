@extends('layouts.panel')

@section('title', 'Base Products')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Create product</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.baseproducts.upload') }}" class="form-inline">
          @csrf

          <div class="form-group mx-sm-3">
            <input type="text" name="name" placeholder="Name" class="form-control">
          </div>
          <input type="submit" class="btn btn-primary" value="Save">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="d-sm-flex align-items-center mb-4">
  <h1 class="h3 mb-0 text-gray-800">List products</h1>
</div>

<div class="row">
  @foreach($baseProducts as $baseProduct)
    @component('panel.components.baseproduct', [ 'baseProduct' => $baseProduct ]) @endcomponent
  @endforeach
</div>
@endsection
