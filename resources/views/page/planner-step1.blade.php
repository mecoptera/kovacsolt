@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  @yield('content')

  <div class="l-container">
    <h3 class="u-text-center">Válassz terméket az alábbiak közül:</h3>

    <div class="q-product-categories">
      <a class="q-product-categories__item" href="{{ route('page.planner.step2', ['product' => 0]) }}">
        <span class="q-product-categories__content">
          <span class="q-product-categories__label">Férfi póló</span>
        </span>
      </a>
      <a class="q-product-categories__item" href="{{ route('page.planner.step2', ['product' => 1]) }}">
        <span class="q-product-categories__content">
          <span class="q-product-categories__label">Női póló</span>
        </span>
      </a>
      <a class="q-product-categories__item" href="{{ route('page.planner.step2', ['product' => 2]) }}">
        <span class="q-product-categories__content">
          <span class="q-product-categories__label">Gyerek póló</span>
        </span>
      </a>
    </div>
  </div>
@endsection
