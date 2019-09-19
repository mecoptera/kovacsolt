@extends('layouts.page')

@section('content')
  <div class="l-container l-container--smaller">
    <div class="q-order-steps">
      <a
        class="q-order-steps__step {{ $step === 0 ? 'q-order-steps__step--current' : 'q-order-steps__step--done' }}"
        @if ($step > 0) href="{{ route('order.profile') }}" @endif
      >
        <span class="q-order-steps__text">Felhasználói fiók</span>
      </a>

      <a
        class="q-order-steps__step {{ $step > 0 ? ($step === 1 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}"
        @if ($step > 1) href="{{ route('order.billing') }}" @endif
      >
        <span class="q-order-steps__text">Számlázási adatok</span>
      </a>

      <a
        class="q-order-steps__step {{ $step > 1 ? ($step === 2 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}"
        @if ($step > 2) href="{{ route('order.shipping') }}" @endif
      >
        <span class="q-order-steps__text">Átvételi mód</span>
      </a>

      <a
        class="q-order-steps__step {{ $step > 2 ? ($step === 3 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}"
        @if ($step > 3) href="{{ route('order.payment') }}" @endif
      >
        <span class="q-order-steps__text">Fizetési mód</span>
      </a>

      <a class="q-order-steps__step {{ $step > 3 ? ($step === 4 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}">
        <span class="q-order-steps__text">Véglegesítés</span>
      </a>
    </div>

    @yield('order-step')
  </div>
@endsection
