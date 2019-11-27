@extends('layouts.page')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Nem aktivált fiók</h1>

      @if (session('resent'))
        <div class="l-grid__row u-text-center">
          <div class="u-mx-auto l-grid__col-sm-8">
            <div class="c-panel__notification">Az aktiváló linket sikeresen újraküldtük, ellenőrizd a beérkezett leveleid!</div>
          </div>
        </div>
      @endif

        <div class="c-panel__content">
          <div class="l-grid__row u-text-center">
            <div class="u-mx-auto l-grid__col--8">
              <p class="u-align-center">Mielőtt új megerősítést kérnél, kérlek ellenőrizd újra az e-mailjeid!<br>Amennyiben nem kaptál levelet, <a href="{{ route('user.verification.resend') }}">kattints erre a linkre</a>!</p>
            </div>
          </div>
          <div class="l-grid__row u-text-center">
            <div class="u-mx-auto l-grid__col--8 u-text-center">
              <a class="c-button c-button--outline" href="{{ route('page.welcome') }}">Vissza a kezdőoldalra</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
