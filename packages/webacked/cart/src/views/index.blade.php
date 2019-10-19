@extends('layouts.page')

@section('title', 'Kosár')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Kosár tartalma</h1>

        <div class="l-grid">
          <div class="q-cart-summary l-grid__col--8 l-grid__col--offset-2">
            <table class="c-table">
              <thead class="c-table__head">
                <tr>
                  <th class="c-table__cell c-table__cell--head"></th>
                  <th class="c-table__cell c-table__cell--head">Termék</th>
                  <th class="c-table__cell c-table__cell--head">Ár</th>
                  <th class="c-table__cell c-table__cell--head">Mennyiség</th>
                </tr>
              </thead>
              <tbody class="c-table__body">
                @foreach($cart as $item)
                  @component('cart::components.product', [ 'item' => $item ]) @endcomponent
                @endforeach
              </tbody>
            </table>

            <div class="l-form__field u-align-right">
              <div class="u-py-4">Szállítás: <b>{{ $shippingPrice }} Ft</b></div>
              <div class="q-cart-summary__total u-py-4">Összesen: <b>{{ $priceTotal }} Ft</b></div>
            </div>
          </div>
        </div>

        <div class="l-form__field u-align-center">
          <a href="{{ route('order.profile') }}" class="c-button">Tovább a pénztárhoz</a>
        </div>
      </div>
    </div>
  </div>
{{--
<div class="l-container l-container--smaller l-container--padding q-cart-summary">
  <h2>Kosár</h2>

  <form class="l-form">
    <div class="l-form__field">
      <table class="c-table">
        <thead class="c-table__head">
          <tr>
            <th class="c-table__cell c-table__cell--head"></th>
            <th class="c-table__cell c-table__cell--head">Termék</th>
            <th class="c-table__cell c-table__cell--head">Ár</th>
            <th class="c-table__cell c-table__cell--head">Mennyiség</th>
          </tr>
        </thead>
        <tbody class="c-table__body">
          @foreach($cart as $item)
            @component('cart::components.product', [ 'item' => $item ]) @endcomponent
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="l-form__field u-align-right">
      <div class="q-cart-summary__total">Összesen: <b>{{ $priceTotal }} Ft</b></div>
    </div>


  </form>
</div> --}}
@endsection
