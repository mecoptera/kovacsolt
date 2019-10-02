@extends('layouts.page')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Bejelentkezés</h1>

        <div class="l-grid">
          <form class="l-form l-grid__col--6 l-grid__col--offset-" method="post" action="{{ route('user.login') }}">
            @csrf

            <k-input
              data-name="email"
              data-label="E-mail cím"
              @if (old('email'))data-value="{{ old('email') }}"@endif
              @error('email')data-error @enderror
            ></k-input>

            <k-input
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error @enderror
            >
              <template data-helper><a href="{{ route('user.password.email') }}">Elfelejtettem a jelszavam</a></template>
            </k-input>

            <k-checkbox
              data-name="remember"
              data-label="Emlékezz rám ezen a gépen"
            ></k-checkbox>

            <div class="u-align-center">
              <input type="submit" class="c-button" value="Bejelentkezés">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="q-login-helper">
      <div class="q-login-helper__content">
        <div class="q-login-helper__text">Még nincs felhasználói fiókod?</div>

        <div class="q-login-helper__action">
          <a class="c-button c-button--primary" href="{{ route('user.register') }}">Regisztrálok</a>
        </div>
      </div>
    </div>
  </div>
@endsection
