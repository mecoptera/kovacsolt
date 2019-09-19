@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-text-center">Számlázási adatok</h2>

  <form class="l-form" method="post" action="{{ route('order.billing') }}">
    @csrf

    <div class="l-form__field">
      <k-input
        data-name="name"
        data-label="Név"
        @if (isset($billingData['name']))data-value="{{ $billingData['name'] }}"@endif
        @error('name')data-error="{{ $message }}"@enderror
      ></k-input>
    </div>

    <div class="l-form__field">
      <k-input
        data-name="zip"
        data-label="Irányítószám"
        data-placeholder="Példa: 1123"
        @if (isset($billingData['zip']))data-value="{{ $billingData['zip'] }}"@endif
        @error('zip')data-error="{{ $message }}"@enderror
      ></k-input>
    </div>

    <div class="l-form__field">
      <k-input
        data-name="city"
        data-label="Város"
        data-placeholder="Példa: Budapest"
        @if (isset($billingData['city']))data-value="{{ $billingData['city'] }}"@endif
        @error('city')data-error="{{ $message }}"@enderror
      ></k-input>
    </div>

    <div class="l-form__field">
      <k-input
        data-name="address"
        data-label="Cím"
        data-placeholder="Példa: Ferenc tér 32. 4/10"
        @if (isset($billingData['address']))data-value="{{ $billingData['address'] }}"@endif
        @error('address')data-error="{{ $message }}"@enderror
      ></k-input>
    </div>

    <div class="l-form__field">
      <k-input
        data-name="email"
        data-label="E-mail cím"
        @if (isset($billingData['email']))data-value="{{ $billingData['email'] }}"@endif
        @error('email')data-error="{{ $message }}"@enderror
      ></k-input>
    </div>

    <div class="l-form__field">
      <k-input
        data-name="phone"
        data-label="Telefonszám"
        data-placeholder="Példa: 06 12 345 6789"
        data-helper="Nem kötelező kitölteni"
        @if (isset($billingData['phone']))data-value="{{ $billingData['phone'] }}"@endif
      ></k-input>
    </div>

    <div class="l-form__field u-align-right">
      <input type="submit" class="c-button" value="Tovább a szállítási módokhoz">
    </div>
  </form>
@endsection
