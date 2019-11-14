@extends('layouts.panel')

@section('title', 'Base Products')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Edit view</h1>
  <a href="{{ route('panel.views') }}" class="btn btn-primary">Back to Views</a>
</div>

<div class="row">
  <div class="col-lg-6 offset-lg-3">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ route('panel.views.update', [ 'id' => $view->id ]) }}">
          @csrf

          <div class="form-group">
            <label for="name">Name in select:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $view->name }}">
          </div>
          <div class="form-group">
            <label for="alias">Alias:</label>
            <input type="text" name="alias" id="alias" placeholder="Alias" class="form-control" value="{{ $view->alias }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
