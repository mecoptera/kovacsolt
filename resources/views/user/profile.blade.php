@extends('layouts.page')

@section('title', 'Felhasználói fiók')

@section('content')
  <div class="l-container">
    <div class="c-tabs">
      <div class="c-tab c-tab--active">
        <div class="c-tab__content">Fiók</div>
      </div>
      <a href="{{ route('user.profile') }}" class="c-tab">
        <span class="c-tab__content">Számlázás</span>
      </a>
      <a href="{{ route('user.profile') }}" class="c-tab">
        <span class="c-tab__content">Szállítás</span>
      </a>
    </div>

    <div class="c-panel">
      <div class="c-panel__content">
        <h2 class="u-align-center">Fiók beállításai</h2>

        <form class="l-form" method="post" action="{{ route('user.profile.save') }}">
          @csrf

          <div class="l-grid">
            <div class="l-grid__col--6 l-grid__col--offset-3">
              @if(session()->has('success'))
                <k-notification data-status="success">{{ session()->get('success') }}</k-notification>
              @endif
              @if(session()->has('error'))
                <k-notification data-status="error">{{ session()->get('error') }}</k-notification>
              @endif

              <div>
                <k-input
                  data-name="name"
                  data-label="Név"
                  @if (isset($userData['name']))data-value="{{ $userData['name'] }}"@endif
                  @error('name')data-error="{{ $message }}"@enderror
                ></k-input>
              </div>

              <div>
                <k-input
                  data-name="email"
                  data-label="E-mail cím"
                  data-helper="Megerősítő e-mailt fogunk küldeni az új címre"
                  @if (isset($userData['email']))data-value="{{ $userData['email'] }}"@endif
                  @error('email')data-error="{{ $message }}"@enderror
                ></k-input>
              </div>

              <div>
                <k-input
                  data-name="phone"
                  data-label="Telefonszám"
                  @if (isset($userData['phone']))data-value="{{ $userData['phone'] }}"@endif
                  @error('phone')data-error="{{ $message }}"@enderror
                ></k-input>
              </div>

              <div class="l-form__field">
                <a href="">Jelszó megváltoztatása</a>
                <div class="u-helper">E-mailt fogunk küldeni, melyben egy linket találsz a jelszó megváltoztatásához</div>
              </div>

              <div class="l-form__field u-align-center">
                <input type="submit" class="c-button" value="Mentés">
              </div>

              <div class="u-align-center">
                <a class="c-button c-button--outline" href="{{ route('user.logout') }}">Kijelentkezés</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

