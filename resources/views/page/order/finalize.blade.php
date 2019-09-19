@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-text-center">Rendelés összesítése</h2>

  <h3>Termékek</h3>

  <div class="q-cart-summary">
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
      <div class="q-cart-summary__total">Összesen: <b>{{ $priceTotal }} Ft</b></div>
    </div>
  </div>

  <h3>Számlázási adatok</h3>
  <table class="c-table">
    <tbody class="c-table__body">
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Név:</b></td>
        <td class="c-table__cell">{{ $billingData['name'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Irányítószám:</b></td>
        <td class="c-table__cell">{{ $billingData['zip'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Város:</b></td>
        <td class="c-table__cell">{{ $billingData['city'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Cím:</b></td>
        <td class="c-table__cell">{{ $billingData['address'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>E-mail cím:</b></td>
        <td class="c-table__cell">{{ $billingData['email'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Telefonszám:</b></td>
        <td class="c-table__cell">{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</td>
      </tr>
    </tbody>
  </table>

  <h3>Szállítási adatok</h3>
  <table class="c-table">
    <tbody class="c-table__body">
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Átvételi mód:</b></td>
        <td class="c-table__cell">{{ $shippingData['shipping_method_text'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Fizetési mód:</b></td>
        <td class="c-table__cell">{{ $paymentData['payment_method_text'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Név:</b></td>
        <td class="c-table__cell">{{ $shippingData['name'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Irányítószám:</b></td>
        <td class="c-table__cell">{{ $shippingData['zip'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Város:</b></td>
        <td class="c-table__cell">{{ $shippingData['city'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Cím:</b></td>
        <td class="c-table__cell">{{ $shippingData['address'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>E-mail cím:</b></td>
        <td class="c-table__cell">{{ $shippingData['email'] }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Telefonszám:</b></td>
        <td class="c-table__cell">{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</td>
      </tr>
      <tr class="c-table__row">
        <td class="c-table__cell u-align-right"><b>Megjegyzés a szállítással kapcsolatban:</b></td>
        <td class="c-table__cell">{{ $shippingData['comment'] ? $shippingData['comment'] : '---' }}</td>
      </tr>
    </tbody>
  </table>

  <form class="l-form" method="post" action="{{ route('order.shipping') }}">
    @csrf

    <div name="comment" class="l-form__field">
      <k-textarea
        data-name="comment"
        data-label="Megjegyzés"
        data-helper="Nem kötelező kitölteni"
        @if (isset($billingData['comment']))data-value="{{ $billingData['comment'] }}"@endif
      ></k-textarea>
    </div>

    <div class="l-form__field u-align-right">
      <input type="submit" class="c-button" value="Rendelés leadása">
    </div>
  </form>
@endsection
