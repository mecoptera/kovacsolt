@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  @yield('content')

  <div class="l-container">
    <h3 class="u-text-center">Válassz terméket az alábbiak közül:</h3>

    <div class="q-product-categories">
      <div class="q-product-categories__item">
        <div class="q-product-categories__content">
          <div class="q-product-categories__label">Férfi póló</div>
        </div>
      </div>
      <div class="q-product-categories__item">
        <div class="q-product-categories__content">
          <div class="q-product-categories__label">Női póló</div>
        </div>
      </div>
      <div class="q-product-categories__item">
        <div class="q-product-categories__content">
          <div class="q-product-categories__label">Gyerek póló</div>
        </div>
      </div>
    </div>
  </div>
@endsection
