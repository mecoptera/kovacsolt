<tr class="c-table__row">
  <td class="c-table__cell"><img src="{{ $item['product']->design }}" class="q-cart-summary__image"></td>
  <td class="c-table__cell c-table__cell--large">{{ $item['product']->name }}</td>
  <td class="c-table__cell c-table__cell--medium">
    <div class="q-cart-summary__price q-cart-summary__price--discount">
      <span class="q-cart-summary__price-original">{{ $item['product']->priceFormatted }}</span>
      {{ $item['product']->discountPriceFormatted }} Ft
    </div>
  </td>
  <td class="c-table__cell">
    <div class="q-cart-summary__quantity">{{ $item['quantity'] }}</div>
  </td>
</tr>
