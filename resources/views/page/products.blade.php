@extends('layouts.page')

@section('title', 'Katalógus')

@section('content')
<div class="l-container l-container--padding">
  <h2>Termékek</h2>

  <div class="q-products">
    @foreach($products as $product)
      @component('page.components.product', [ 'product' => $product ]) @endcomponent
    @endforeach
  </div>
</div>
@endsection
