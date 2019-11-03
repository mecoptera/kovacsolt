@extends('layouts.page')

@section('title', 'Kosár')

@section('content')
  <div class="l-container" _namespace="cart-index">
    <div class="c-panel">
      <div class="c-panel__content">
        <form action="{{ route('cart') }}" method="post">
          @csrf

          <h1 class="c-panel__title">Kosár tartalma</h1>

          <div class="l-grid">
            <div class="l-grid__col--8 l-grid__col--offset-2">
              <table class="c-table">
                <thead class="c-table__head">
                  <tr>
                    <th class="c-table__cell c-table__cell--head"></th>
                    <th class="c-table__cell c-table__cell--head">Termék</th>
                    <th class="c-table__cell c-table__cell--head">Ár</th>
                    <th class="c-table__cell c-table__cell--head">Mennyiség</th>
                  </tr>
                </thead>
                <tbody class="c-table__body">
                  @foreach($cart as $item)
                    @component('cart::components.product', [ 'item' => $item, 'editable' => true ]) @endcomponent
                  @endforeach
                </tbody>
              </table>

              <div class="l-form__field u-text-right">
                <div class="l-grid q-cart-summary__total">
                  <div class="l-grid__col--2 l-grid__col--offset-8">Összesen:</div>
                  <div class="l-grid__col--2"><b><k-format  id="js-price"></k-format> Ft</b></div>
                </div>
              </div>
            </div>
          </div>

          <div class="l-form__field u-text-center">
            <button class="c-button">Tovább a pénztárhoz</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
