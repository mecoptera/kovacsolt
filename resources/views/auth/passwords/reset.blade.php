@extends('layouts.page')

@section('title', 'Új jelszó')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Új jelszó</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6" method="post" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <k-input
              data-name="email"
              data-label="E-mail cím"
              data-value="{{ $email ?? old('email') }}"
              @error('email')data-error="{{ $message }}" @enderror
            ></k-input>

            <k-input
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error="{{ $message }}" @enderror
            >
            </k-input>

            <k-input
              data-type="password"
              data-name="password_confirmation"
              data-label="Jelszó újra"
            >
            </k-input>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Mentés">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
