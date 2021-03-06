<tr class="c-table__row js-product" data-price="{{ $item['product']->discount ? $item['product']->discountPrice : $item['product']->price }}">
  <td class="c-table__cell">
    <k-product-card class="u-w-48 u-h-48" data-detail="{{ $item['product'] }}" data-hide-info></k-product-card>
  </td>
  <td class="c-table__cell c-table__cell--large">
    <span class="u-font-bold u-uppercase">{{ $item['product']->name }}</span>

    <div class="u-mt-4 u-pt-4 u-border-t u-border-color-form u-text-sm">
      @if (isset($item['extraData']['size']))
        <div>Méret: <b>{{ strtoupper($item['extraData']['size']) }}</b></div>
      @endif
    </div>
  </td>
  <td class="c-table__cell c-table__cell--medium">
    <div>
      <span class="{{ $item['product']->discount ? 'u-line-through u-text-xs' : 'u-font-bold' }}">
        <k-format data-value="{{ $item['product']->price }}"></k-format> Ft
      </span>
      {!! $item['product']->discount ? '<div class="u-font-bold u-text-color-brand"><k-format data-value="' . $item['product']->discountPrice . '"></k-format> Ft</div>' : '' !!}
    </div>
  </td>
  <td class="c-table__cell">
    @if (isset($editable) && $editable)
      <k-number-input data-name="quantity[{{ $item['uniqueId'] }}]" data-value="{{ $item['quantity'] }}" class="js-quantity"></k-number-input>
    @else
      {{ $item['quantity'] }} db
    @endif
  </td>
</tr>
