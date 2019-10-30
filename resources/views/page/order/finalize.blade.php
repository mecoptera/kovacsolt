@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Rendelés összesítése</h1>

      <div class="l-grid u-mb-16">
        <div class="q-cart-summary l-grid__col--8 l-grid__col--offset-2">
          <h3>Termékek</h3>

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
                @component('cart::components.product', [ 'item' => $item ]) @endcomponent
              @endforeach
            </tbody>
          </table>

          <div class="l-form__field u-text-right">
              <div>Termékek: <b>{{ $price }} Ft</b></div>
              <div class="u-py-4">Szállítás: <b>{{ $shippingPrice }} Ft</b></div>
              <div class="q-cart-summary__total u-py-4">Összesen: <b>{{ $priceTotal }} Ft</b></div>
          </div>
        </div>
      </div>

      <div class="l-grid u-mb-16">
        <div class="l-grid__col--8 l-grid__col--offset-2">
          <h3>Számlázási adatok</h3>

          <div class="l-grid">
            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Név:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['name'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Irányítószám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['zip'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Város:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['city'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['address'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>E-mail cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['email'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Telefonszám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</div>
          </div>
        </div>
      </div>

      <div class="l-grid">
        <div class="l-grid__col--8 l-grid__col--offset-2">
          <h3>Szállítási adatok</h3>

          <div class="l-grid">
            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Átvételi mód:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['shipping_method_text'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Fizetési mód:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $paymentData['payment_method_text'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Név:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['name'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Irányítószám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['zip'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Város:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['city'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['address'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>E-mail cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['email'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Telefonszám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Megjegyzés a szállítással kapcsolatban:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['comment'] ? $shippingData['comment'] : '---' }}</div>
          </div>
        </div>
      </div>

      <div class="l-grid">
        <div class="l-grid__col--6 l-grid__col--offset-3">
          <form class="l-form" method="post" action="{{ route('order.finalize') }}">
            @csrf

            <k-textarea
              data-name="comment"
              data-label="Egyéb megjegyzés"
              data-helper="Nem kötelező kitölteni"
              @if (isset($finalizeData['comment']))data-value="{{ $finalizeData['comment'] }}"@endif
            ></k-textarea>

            <div class="l-form__field u-text-center">
              <input type="submit" class="c-button" value="Rendelés leadása">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
