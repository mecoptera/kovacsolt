@extends('layouts.page')

@section('title', 'Rendelés leadása')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content u-text-center">
        <h1 class="c-panel__title">Rendelés sikeres!</h1>

        <p>A rendelésed sikeresen leadtuk, hamarosan értesítünk.<br>Rendelésed azonosítója:</p>
      <div class="u-inline-block u-text-5xl">{{ $orderId }}</div></div>
    </div>
  </div>
@endsection
