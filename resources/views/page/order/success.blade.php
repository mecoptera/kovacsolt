@extends('layouts.page')

@section('title', 'Rendelés leadása')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Rendelés sikeres!</h1>

        <p class="u-text-center">Rendelésed azonosítója: <strong>{{ $orderId }}</strong></p>
      </div>
    </div>
  </div>
@endsection
