@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-align-center">Felhasználói fiók</h2>

  <div class="l-grid">
    <div class="l-grid l-grid__col l-grid__col-sm-6 l-grid__center-sm l-grid__middle-sm">
      <form method="post" action="{{ route('login', [ 'from' => 'order' ]) }}">
        @csrf

        <div class="l-form__field">
          <k-input
            data-name="email"
            data-label="E-mail cím"
            data-value="{{ old('email') }}"
            @error('email')data-error="{{ $message }}"@enderror
          ></k-input>
        </div>

        <div class="l-form__field">
          <k-input
            data-type="password"
            data-name="password"
            data-label="Jelszó"
            @error('password')data-error="{{ $message }}"@enderror
          ></k-input>
        </div>

        <div class="l-form__field">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>

        <div class="l-form__field">
          <button type="submit" class="c-button">{{ __('Login') }}</button>
        </div>

      @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request', [ 'from' => 'order' ]) }}">{{ __('Forgot Your Password?') }}</a>
      @endif
      </form>
    </div>

    <div class="l-grid l-grid__col l-grid__col-sm-6 l-grid__center-sm l-grid__middle-sm">
      <a class="c-button c-button--outline" href="{{ route('order.billing') }}">Vendégként folytatom</a>
    </div>
  </div>
@endsection
