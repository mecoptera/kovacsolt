<k-product-card
  class="u-m-4"
  data-csrf="{{ csrf_token() }}"
  data-detail="{{ $product }}"
  data-planner-url="{{ route('page.planner.step2', [ 'product' => $product->id ]) }}"
  data-cart-url="{{ route('cart.add') }}">
</k-product-card>
