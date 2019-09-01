@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-text-center">Felhasználói fiók</h2>

  <div class="l-grid">
    <div class="l-grid__col l-grid__col-sm-6">
      <form method="POST" action="{{ route('login', [ 'from' => 'order' ]) }}">
        @csrf

        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>


        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>

      @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request', [ 'from' => 'order' ]) }}">{{ __('Forgot Your Password?') }}</a>
      @endif
      </form>
    </div>

    <div class="l-grid__col l-grid__col-sm-6">
      <a href="{{ route('order.billing') }}">Vendégként folytatom</a>
    </div>
  </div>
@endsection
