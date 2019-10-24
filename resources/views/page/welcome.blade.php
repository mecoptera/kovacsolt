@extends('layouts.page')

@section('title', 'Kezdőlap')

@section('content')
<div class="l-container l-container--stretch q-welcome">
  <div class="l-container q-welcome__container">
    <div class="q-welcome__headline">
      <div class="q-welcome__plan"></div>
      <div class="q-welcome__sub">Készítsd el egyedi pólód nálunk</div>
    </div>

    <div class="q-welcome__footer">
      <div class="q-welcome__description">
        <div class="q-welcome__about">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos ducimus consequuntur, vero totam nisi. Necessitatibus tempora provident officia, repellat eius repellendus similique quam qui ut dolore sed aspernatur dicta. Veniam!</p>

          <a href="{{ route('page.planner.step1') }}" class="c-button c-button--link">Tudj meg többet</a>
        </div>
        <div class="q-welcome__planner">
          <a href="{{ route('page.planner.step1') }}" class="c-button c-button--arrow">Tervező megnyitása</a>
        </div>
      </div>

      <div class="q-welcome__contact">
        <div class="q-welcome__copyright">© {{ date('Y') }} Kovácsolt Póló</div>

        <div class="q-welcome__social">
          <a href="{{ route('page.planner.step1') }}" class="c-icon c-icon--facebook c-icon--white"></a>
          <a href="{{ route('page.planner.step1') }}" class="c-icon c-icon--instagram c-icon--white"></a>
          <a href="{{ route('page.planner.step1') }}" class="c-icon c-icon--twitter c-icon--white"></a>
        </div>

        <div class="q-welcome__phone">Tel.: +36 12 345 6789</div>
      </div>
    </div>
  </div>
</div>

<div class="l-container l-container--padding">
  <h2>Termékek</h2>

  <div class="q-products l-grid">
    @foreach($products as $product)
      <div class="l-grid__col--3">
        @component('page.components.product', [ 'product' => $product ]) @endcomponent
      </div>
    @endforeach

    <div class="q-products__more">
      <a href="{{ route('page.products') }}" class="c-button c-button--outline c-button--fluid">Tovább a többi termékhez</a>
    </div>
  </div>
</div>

<div class="q-contact">
  <div class="l-container l-container--smaller l-container--padding q-contact__content">
    <h2>Feliratkozás hírlevélre</h2>
    <p>Amennyiben a későbbiekben szeretnél értesülni a legújabb akciókról, ne habozz, add meg a címed lent.</p>

    <div class="q-contact__form">
      <div class="q-contact__email">
        <k-input data-label="E-mail cím"></k-input>
      </div>

      <a href="javascript:void(0)" class="c-button c-button--outline q-contact__button">Feliratkozás</a>
    </div>
  </div>
</div>

@endsection
