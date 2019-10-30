@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Szállítási adatok</h1>

      <div class="l-grid">
        <form class="l-form l-grid__col--6 l-grid__col--offset-3 u-flex u-flex-col" method="post" action="{{ route('order.shipping') }}">
          @csrf

          <k-select
            data-name="shipping_method"
            data-label="Átvétel módja"
            data-placeholder="Válassz átvételi módot"
            @if (isset($shippingData['shipping_method']))data-value="{{ $shippingData['shipping_method'] }}"@endif
          >
            <k-select-option data-value="0">Személyes átvétel</k-select-option>
            <k-select-option data-value="1">Postai átvétel</k-select-option>
            <k-select-option data-value="2">Házhozszállítás</k-select-option>
            <k-select-option data-value="3">Átvétel csomagponton</k-select-option>
          </k-select>

          <k-input
            data-name="name"
            data-label="Név"
            @if (isset($shippingData['name']))data-value="{{ $shippingData['name'] }}"@endif
            @error('name')data-error="{{ $message }}"@enderror
          ></k-input>

          <k-input
            data-name="zip"
            data-label="Irányítószám"
            data-placeholder="Példa: 1123"
            @if (isset($shippingData['zip']))data-value="{{ $shippingData['zip'] }}"@endif
            @error('zip')data-error="{{ $message }}"@enderror
          ></k-input>

          <k-input
            data-name="city"
            data-label="Város"
            data-placeholder="Példa: Budapest"
            @if (isset($shippingData['city']))data-value="{{ $shippingData['city'] }}"@endif
            @error('city')data-error="{{ $message }}"@enderror
          ></k-input>

          <k-input
            data-name="address"
            data-label="Cím"
            data-placeholder="Példa: Ferenc tér 32. 4/10"
            @if (isset($shippingData['address']))data-value="{{ $shippingData['address'] }}"@endif
            @error('address')data-error="{{ $message }}"@enderror
          ></k-input>

          <k-input
            data-name="email"
            data-label="E-mail cím"
            @if (isset($shippingData['email']))data-value="{{ $shippingData['email'] }}"@endif
            @error('email')data-error="{{ $message }}"@enderror
          ></k-input>

          <k-input
            data-name="phone"
            data-label="Telefonszám"
            data-placeholder="Példa: 06 12 345 6789"
            data-helper="Nem kötelező kitölteni"
            @if (isset($shippingData['phone']))data-value="{{ $shippingData['phone'] }}"@endif
          ></k-input>

          <k-textarea
            data-name="comment"
            data-label="Megjegyzés"
            data-helper="Nem kötelező kitölteni"
            @if (isset($shippingData['comment']))data-value="{{ $shippingData['comment'] }}"@endif
          ></k-textarea>

          <div class="l-form__field u-text-center">
            <input type="submit" class="c-button" value="Tovább a fizetési módokhoz">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

