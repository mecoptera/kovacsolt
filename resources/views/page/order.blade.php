@extends('layouts.page')

@section('content')
  <div class="l-container l-container--smaller">
    <div class="q-order-steps">
      <div class="q-order-steps__step {{ $step === 0 ? 'q-order-steps__step--current' : 'q-order-steps__step--done' }}">
        <div class="q-order-steps__text">Felhasználói fiók</div>
      </div>
      <div class="q-order-steps__step {{ $step > 0 ? 'q-order-steps__step--done' : $step === 1 ? 'q-order-steps__step--current' : '' }}">
        <div class="q-order-steps__text">Számlázási adatok</div>
      </div>
      <div class="q-order-steps__step {{ $step > 1 ? 'q-order-steps__step--done' : $step === 2 ? 'q-order-steps__step--current' : '' }}">
        <div class="q-order-steps__text">Átvételi mód</div>
      </div>
      <div class="q-order-steps__step {{ $step > 2 ? 'q-order-steps__step--done' : $step === 3 ? 'q-order-steps__step--current' : '' }}">
        <div class="q-order-steps__text">Fizetési mód</div>
      </div>
      <div class="q-order-steps__step {{ $step > 3 ? 'q-order-steps__step--done' : $step === 4 ? 'q-order-steps__step--current' : '' }}">
        <div class="q-order-steps__text">Véglegesítés</div>
      </div>
    </div>

    @yield('order-step')
  </div>
@endsection
