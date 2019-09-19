@extends('layouts.page')

@section('content')
  <div class="l-grid">
    <div class="l-grid__row l-grid__row--center">
      <div class="l-grid__col-sm-6 c-panel">
        <h1 class="c-panel__title">Bejelentkezés</h1>

        <div class="c-panel__content">
          <form class="l-form l-grid" method="post" action="{{ route('user.login') }}">
            @csrf

            <div class="l-grid__row l-grid__row--center">
              <div class="l-grid__col-sm-8">
                <k-input
                  data-fluid
                  data-name="email"
                  data-label="E-mail cím"
                  @if (old('email'))data-value="{{ old('email') }}"@endif
                  @error('email')data-error @enderror
                ></k-input>
              </div>

              <div class="l-grid__col-sm-8">

                <k-input
                  data-fluid
                  data-type="password"
                  data-name="password"
                  data-label="Jelszó"
                  @error('password')data-error @enderror
                >
                  <template data-helper><a href="{{ route('user.password.email') }}">Elfelejtettem a jelszavam</a></template>
                </k-input>
              </div>
            </div>

            <div class="l-grid__row l-grid__row--center">
              <div class="l-grid__col-sm-8">
                <k-checkbox
                  data-fluid
                  data-name="remember"
                  data-label="Emlékezz rám ezen a gépen"
                ></k-checkbox>
              </div>
            </div>

            <div class="l-grid__row l-grid__row--center">
              <div class="l-grid__col-sm-8 l-form__field u-align-center">
                <input type="submit" class="c-button" value="Bejelentkezés">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="l-grid__row l-grid__row--center">
      <div class="l-grid__col-sm-6 q-login-helper">
        <div class="q-login-helper__content">
          <div class="q-login-helper__text">Még nincs felhasználói fiókod?</div>

          <div class="q-login-helper__action">
            <a class="c-button c-button--primary" href="{{ route('user.register') }}">Regisztrálok</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
