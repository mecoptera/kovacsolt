@extends('layouts.page')

@section('title', 'Kapcsolat')

@section('content')
<div class="l-container l-container--smaller l-container--padding">
  <h2 class="u-text-center">Hagyjon üzenetet!</h2>
  <p class="u-text-center">Amennyiben kérdése van, ajánlatot kérne, vagy visszajelzést szeretne adni, küldjön üzenetet a <a href="mailto: hello@kovacsoltpolo.hu">hello@kovacsoltpolo.hu</a> címre. Az alábbi űrlap segítségével gyorsabban is üzenhet.</p>

  <form class="l-form">
    <div class="l-form__field c-input">
      <input type="text" placeholder="Név" class="c-input__field">
      <div class="c-input__label" data-label="Név"></div>
    </div>

    <div class="l-form__field c-input">
      <input type="text" placeholder="E-mail cím" class="c-input__field">
      <div class="c-input__label" data-label="E-mail cím"></div>
    </div>

    <div class="l-form__field c-input">
      <k-textarea data-placeholder="Üzenet"></k-textarea>
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
      <a href="javascript:void(0)" class="c-button">Küldés</a>
    </div>
  </form>
</div>
@endsection
