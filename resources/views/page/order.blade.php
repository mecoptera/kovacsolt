@extends('layouts.page')

@section('title', 'Rendelés leadása')

@section('content')
<div class="l-container l-container--smaller l-container--padding">
  <h2 class="u-text-center">Szállítási és számlázási adatok</h2>

  <form class="l-form">
    <div class="l-form__field c-input c-input--small">
      <input type="text" placeholder="Név" class="c-input__field">
      <div class="c-input__label" data-label="Név"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <input type="text" placeholder="E-mail cím" class="c-input__field">
      <div class="c-input__label" data-label="E-mail cím"></div>
    </div>

    <div class="l-form__field c-input c-input--small">
      <k-textarea data-placeholder="Üzenet" data-size="small"></k-textarea>
    </div>

    <div class="l-form__field">
      <label class="c-checkbox">
        <input type="checkbox">
        <div class="c-checkbox__label">
          <span>Megértettem és elfogadom az <a href="{{ route('page.privacy') }}" target="_blank">Adatkezelési tájékoztató</a>ban leírtakat</span>
        </div>
      </label>
    </div>

    <div class="l-form__field u-text-center">
      <a href="{{ route('pay') }}" class="c-button">Megrendelés</a>
    </div>
  </form>
</div>
@endsection
