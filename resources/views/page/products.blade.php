@extends('layouts.page')

@section('title', 'Katalógus')

@section('content')
<div class="l-container">
  <h2>Termékek</h2>

  <div class="q-products l-grid">
    @foreach($products as $product)
      <div class="l-grid__col--3">
        <k-product-card class="u-m-4" data-detail="{{ $product }}" data-url="{{ route('page.product', [ 'id' => $product->id]) }}">
          <k-product-card-action data-label="Tovább a termékhez" data-url="{{ route('page.product', [ 'id' => $product->id]) }}" data-icon="eye"></k-product-card-action>
        </k-product-card>
      </div>
    @endforeach
  </div>
</div>
@endsection
