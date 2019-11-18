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
      <div class="c-panel" style="min-height: 100%;">
        <div class="c-panel__content">
          <div class="u-mb-2 u-uppercase u-text-4xl u-font-bold">{{ $product->name }}</div>
          <div class="u-mb-2 u-text-color-form">{{ $product->base_product_name }}</div>

          <div class="u-mb-12">
          @if ($product->discount)
            <div class="u-inline-block u-mr-4 u-text-2xl u-font-bold u-line-through"><k-format data-value="{{ $product->price }}"></k-format> Ft</div>
            <div class="u-inline-block u-text-color-brand u-text-4xl u-font-bold"><k-format data-value="{{ $product->discountPrice }}"></k-format> Ft</div>
          @else
            <div class="u-text-4xl u-font-bold"><k-format data-value="{{ $product->price }}" data-postfix="Ft"></k-format></div>
          @endif
          </div>

          <div class="u-mb-2 u-uppercase u-font-bold">Termék leírása</div>
          <div class="u-mb-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A esse, tempore, cum voluptate laboriosam odio id ab quasi voluptas velit eius possimus nesciunt. Corporis commodi natus nam velit delectus harum.</div>

          <form method="post" action="{{ route('cart.add', [ 'productId' => $product->id]) }}">
            @csrf

            <div class="u-mb-2 u-uppercase u-font-bold">Méret</div>

            <k-radiobox data-name="extra_data[size]" data-value="xs" data-label="XS"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="s" data-label="S"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="m" data-label="M" data-checked></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="l" data-label="L"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="xl" data-label="XL"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="2xl" data-label="2XL"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="3xl" data-label="3XL"></k-radiobox>

{{--             <div class="u-mb-12 u-mt-2">
              <a href="#">Méret táblázat</a>
            </div> --}}

            <div class="u-text-center">
              <input type="submit" class="c-button c-button--primary" value="Hozzáadás kosárhoz">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
