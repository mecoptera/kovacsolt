<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Kovácsolt Póló - @yield('title')</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
</head>
<body>
  <div class="l-layout">
    <div class="l-layout__header q-menu {{ Route::currentRouteName() === 'page.welcome' ? 'l-layout__header--alternative q-menu--alternative' : '' }}">
      <div class="l-container q-menu__container">
        <div class="q-menu__left">
          <a class="q-logo {{ Route::currentRouteName() === 'page.welcome' ? 'q-logo--white' : '' }}" href="{{ url('/') }}"></a>
        </div>
        <div class="q-menu__right">
          <k-menu class="q-menu__bar">
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ url('/') }}">Kezdőlap</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ route('page.products') }}">Termékek</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ route('page.planner.step1') }}">Tervező</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ route('page.contact') }}">Kapcsolat</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ route('page.about') }}">Rólunk</a></k-menu-item>
          </k-menu>
          <a class="c-icon c-icon--person {{ Route::currentRouteName() === 'page.welcome' ? 'c-icon--white' : '' }}" href="{{ route('user') }}"></a>
          <k-cart-button class="c-icon c-icon--cart {{ Route::currentRouteName() === 'page.welcome' ? 'c-icon--white' : '' }}">
            <div class="c-icon__badge">{{ Webacked\Cart\Helpers::itemsCount() }}</div>
          </k-cart-button>
        </div>
      </div>
    </div>

    <main class="l-layout__content {{ Route::currentRouteName() === 'page.welcome' ? 'l-layout__content--alternative' : '' }}">
      @yield('content')

      <div class="q-footer">
        <div class="l-container l-container--padding">
          <div class="q-footer__content">
            <div class="q-footer__category">
              <b class="q-footer__title">OLDALTÉRKÉP</b>
              <ul class="q-footer__list">
                <li><a class="q-footer__link" href="{{ url('/') }}">Kezdőlap</a></li>
                <li><a class="q-footer__link" href="{{ url('/references') }}">Referenciák</a></li>
                <li><a class="q-footer__link" href="{{ url('/about') }}">Rólunk</a></li>
                <li><a class="q-footer__link" href="{{ url('/contact') }}">Kapcsolat</a></li>
              </ul>
            </div>
            <div class="q-footer__category">
              <b class="q-footer__title">ADATVÉDELEM</b>
              <ul class="q-footer__list">
                <li><a class="q-footer__link" href="{{ url('/privacy') }}">Adatvédelmi Nyilatkozat</a></li>
              </ul>
            </div>
            <div class="q-footer__category">
              <b class="q-footer__title">ELÉRHETŐSÉGEK</b>
              <ul class="q-footer__list">
                <li><a class="q-footer__link" href="mailto:hello@kovacsoltpolo.hu">hello@kovacsoltpolo.hu</a></li>
                <li><a class="q-footer__link" href="tel:+36 12 345 6789">+36 12 345 6789</a></li>
              </ul>
            </div>
          </div>

          <div class="q-footer__copyright">© {{ date('Y') }} Kovácsolt Póló</div>
        </div>
      </div>
    </main>
  </div>

  <script src="{{ asset('dist/js/main.js') }}"></script>
</body>
</html>
