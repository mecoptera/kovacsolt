@extends('layouts.page')

@section('title', 'Új e-mail cím')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Új jelszó küldése</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6" method="post" action="{{ route('password.email') }}">
            @csrf

            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <k-input
              data-name="email"
              data-label="E-mail cím"
              data-value="{{ $email ?? old('email') }}"
              @error('email')data-error="{{ $message }}" @enderror
            ></k-input>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Küldés">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
