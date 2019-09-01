@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-text-center">Számlázási adatok</h2>

  <form class="l-form" method="post" action="{{ route('order.billing') }}">
    @csrf

    <div class="l-form__field c-input c-input--small">
      <input name="name" type="text" placeholder="Név" class="c-input__field" value="{{ $billingData ? $billingData['name'] : '' }}">
      <div class="c-input__label" data-label="Név"></div>
    </div>

  @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror

    <div class="l-form__field c-input c-input--small">
      <input name="zip" type="text" placeholder="Irányítószám" class="c-input__field">
      <div class="c-input__label" data-label="Irányítószám"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <input name="city" type="text" placeholder="Város" class="c-input__field">
      <div class="c-input__label" data-label="Város"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <input name="address" type="text" placeholder="Utca / házszám" class="c-input__field">
      <div class="c-input__label" data-label="Utca / házszám"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <input name="email" type="text" placeholder="E-mail cím" class="c-input__field">
      <div class="c-input__label" data-label="E-mail cím"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <input name="phone" type="text" placeholder="Telefonszám" class="c-input__field">
      <div class="c-input__label" data-label="Telefonszám"></div>
    </div>

    <div name="comment" class="l-form__field c-input c-input--small">
      <k-textarea data-placeholder="Megjegyzés" data-size="small"></k-textarea>
    </div>

    <div class="l-form__field u-text-center">
      <input type="submit" class="c-button" value="Tovább a szállítási módokhoz">
    </div>
  </form>
@endsection
