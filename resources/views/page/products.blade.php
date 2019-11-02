@extends('layouts.page')

@section('title', 'Katalógus')

@section('content')
<div class="l-container">
  <h2>Termékek</h2>

  <div class="q-products l-grid">
    @foreach($products as $product)
      <div class="l-grid__col--3">
        <k-product-card class="u-m-4" data-detail="{{ $product }}">
          <k-product-card-action data-label="Kosárhoz adás" data-url="{{ route('cart.add', [ 'productId' => $product->id]) }}"></k-product-card-action>
        </k-product-card>
      </div>
    @endforeach
  </div>
</div>
@endsection
