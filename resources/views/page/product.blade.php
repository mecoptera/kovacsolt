@extends('layouts.page')

@section('title', $product->name)

@section('content')
<div class="l-container">
  <h2>Termék részletei</h2>

  <div class="l-grid">
    <div class="l-grid__col--6">
      <k-product-card data-detail="{{ $product }}" data-hide-info data-hi-res></k-product-card>
    </div>
    <div class="l-grid__col--6">
      <div class="c-panel">
        <div class="c-panel__content">
          <div class="u-mb-2 u-uppercase u-text-4xl u-font-bold">{{ $product->name }}</div>
          <div class="u-mb-2 u-text-color-form">{{ $product->base_product_name }}</div>

          <div class="u-mb-12">
          @if ($product->discount)
            <div class="u-inline-block u-mr-4 u-text-2xl u-font-bold u-line-through"><k-format data-value="{{ $product->price }}"></k-format> Ft</div>
            <div class="u-inline-block u-text-color-brand u-text-4xl u-font-bold"><k-format data-value="{{ $product->price }}"></k-format> Ft</div>
          @else
            <div class="u-text-4xl u-font-bold"><k-format data-value="{{ $product->price }}" data-postfix="Ft"></k-format></div>
          @endif
          </div>

          <div class="u-mb-2 u-uppercase u-font-bold">Termék leírása</div>
          <div class="u-mb-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A esse, tempore, cum voluptate laboriosam odio id ab quasi voluptas velit eius possimus nesciunt. Corporis commodi natus nam velit delectus harum.</div>

          <div class="u-mb-2 u-uppercase u-font-bold">Megrendelés</div>

          <form action="">
            <div class="u-inline-block">XS</div>
            <div class="u-inline-block">S</div>
            <div class="u-inline-block">M</div>
            <div class="u-inline-block">L</div>
            <div class="u-inline-block">XL</div>
            <a href="#">Méret táblázat</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
