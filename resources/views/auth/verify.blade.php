@extends('layouts.page')

@section('content')
  <div class="l-grid">
    <div class="l-grid__row l-grid__row--center">
      <div class="l-grid__col-sm-6 c-panel">
        <h1 class="c-panel__title">Nem aktivált fiók</h1>

      @if (session('resent'))
        <div class="l-grid__row l-grid__row--center">
          <div class="l-grid__col-sm-8">
            <div class="c-panel__notification">Az aktiváló linket sikeresen újraküldtük, ellenőrizd a beérkezett leveleid!</div>
          </div>
        </div>
      @endif

        <div class="c-panel__content">
          <div class="l-grid__row l-grid__row--center">
            <div class="l-grid__col-sm-8">
              <p class="u-align-center">Mielőtt új megerősítést kérnél, kérlek ellenőrizd újra az e-mailjeid!<br>Amennyiben nem kaptál levelet, <a href="{{ route('user.verification.resend') }}">kattints erre a linkre</a>!</p>
            </div>
          </div>
          <div class="l-grid__row l-grid__row--center">
            <div class="l-grid__col-sm-8 u-align-center">
              <a class="c-button c-button--outline" href="{{ route('page.welcome') }}">Vissza a kezdőoldalra</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
