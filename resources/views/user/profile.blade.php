@extends('layouts.page')

@section('title', 'Felhasználói fiók')

@section('content')
  <div class="l-container">
    <div class="c-panel u-relative">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Fiók beállításai</h1>

        <div class="u-absolute" style="top: 16px; right: 16px;">
          <a class="c-button c-button--outline c-button--small" href="{{ route('user.logout') }}">Kijelentkezés</a>
        </div>

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
                  data-label="E-mail cím"
                  data-value="{{ $userData['email'] }}"
                  data-disabled
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
                <a href="{{ route('user.password.reset') }}">Jelszó megváltoztatása</a>
                <div class="u-helper">E-mailt fogunk küldeni, melyben egy linket találsz a jelszó megváltoztatásához</div>
              </div>

              <div class="l-form__field u-text-center">
                <input type="submit" class="c-button" value="Mentés">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

