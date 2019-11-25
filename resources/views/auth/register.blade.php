@extends('layouts.page')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Regisztráció</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6 l-grid__col--offset-" method="post" action="{{ route('user.login') }}">
            @csrf

            <k-input
              data-fluid
              data-name="name"
              data-label="Név"
              @if (old('name'))data-value="{{ old('name') }}"@endif
              @error('name')data-error="{{ $message }}" @enderror
            ></k-input>

            <k-input
              data-fluid
              data-name="email"
              data-label="E-mail cím"
              @if (old('email'))data-value="{{ old('email') }}"@endif
              @error('email')data-error="{{ $message }}" @enderror
            ></k-input>

            <k-input
              data-fluid
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error="{{ $message }}" @enderror
            >
            </k-input>

            <k-input
              data-fluid
              data-type="password"
              data-name="password_confirmation"
              data-label="Jelszó újra"
              @error('password')data-error @enderror
            >
            </k-input>

            <k-checkbox data-name="remember">
              <template data-label>Megértettem és elfogadom az&nbsp;<a href="{{ route('page.privacy') }}" target="_blank">Adatkezelési tájékoztatóban</a>&nbsp;leírtakat</template>
            </k-checkbox>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Regisztráció">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="l-grid__row l-grid__row--center">
      <div class="l-grid__col-sm-6 q-login-helper">
        <div class="q-login-helper__content">
          <div class="q-login-helper__text">Rendelkezel már felhasználói fiókkal?</div>

          <div class="q-login-helper__action">
            <a class="c-button c-button--primary" href="{{ route('user.login') }}">Bejelentkezés</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
