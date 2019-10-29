<tr class="c-table__row">
  <td class="c-table__cell">
    <k-product-card class="u-w-48 u-h-48" data-detail="{{ $item['product'] }}" data-hide-info></k-product-card>
  </td>
  <td class="c-table__cell c-table__cell--large">{{ $item['product']->name }}</td>
  <td class="c-table__cell c-table__cell--medium">
    <div>
      <span class="{{ $item['product']->discount ? 'u-line-through u-text-xs' : 'u-font-bold' }}">{{ $item['product']->priceFormatted }} Ft</span>
      {!! $item['product']->discount ? '<div class="u-font-bold u-text-brand">' . $item['product']->discountPriceFormatted . ' Ft</div>' : '' !!}
    </div>
  </td>
  <td class="c-table__cell">{{ $item['quantity'] }}db</td>
</tr>
