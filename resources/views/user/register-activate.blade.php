@extends('layouts.page')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Majdnem kész</h1>

        <div class="c-panel__content">
          <div class="l-grid">
            <div class="u-mx-auto l-grid__col--6">
              <div class="l-grid__row u-text-center">
                <div class="c-panel__status c-panel__status--success"></div>
              </div>

              <div class="l-grid__row l-grid__row--center">
                <div class="l-grid__col-sm-8">
                  <p class="u-text-center">A regisztrációs kérelmed sikeresen fogadtuk és a megadott e-mail címre egy aktiváló linket küldtünk.</p>
                </div>
              </div>
              <div class="l-grid__row l-grid__row--center">
                <div class="l-grid__col-sm-8 u-text-center">
                  <a class="c-button c-button--outline" href="{{ route('page.welcome') }}">Vissza a kezdőoldalra</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
