@extends('layouts.page')

@section('title', 'Kosár')

@section('content')
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

    <div class="l-form__field u-text-right">
      <div class="q-cart-summary__total">Összesen: <b>{{ $priceTotal }} Ft</b></div>
    </div>

    <div class="l-form__field u-text-center">
      <a href="{{ route('page.order') }}" class="c-button">Szállítási adatok megadása</a>
    </div>
  </form>
</div>
@endsection
