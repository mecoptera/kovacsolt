<div class="q-cart-button__container u-mb-3">
  <table class="c-table u-m-0">
    <tbody class="c-table__body">
      @foreach($cart as $item)
        <tr class="c-table__row">
          <td class="c-table__cell">
            <k-product-card class="u-w-24 u-h-24" data-detail="{{ $item['product'] }}" data-hide-info></k-product-card>
          </td>
          <td class="c-table__cell">{{ $item['product']->name }}</td>
          <td class="c-table__cell">
            <div>
              <span class="{{ $item['product']->discount ? 'u-line-through u-text-xs' : 'u-font-bold' }}">{{ $item['product']->priceFormatted }} Ft</span>
              {!! $item['product']->discount ? '<div class="u-font-bold u-text-brand">' . $item['product']->discountPriceFormatted . ' Ft</div>' : '' !!}
            </div>
          </td>
          <td class="c-table__cell">{{ $item['quantity'] }}db</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="u-text-center">
  <a href="{{ route('cart') }}" class="c-button c-button--small">Tovább a fizetéshez</a>
</div>
