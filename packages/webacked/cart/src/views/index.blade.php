@extends('layouts.page')

@section('content')
<div class="l-container l-container--smaller l-container--padding">
  <h2>Kosár</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Ár</th>
        <th>Mennyiség</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cart as $product)
        @component('cart::components.product', [
          'name' => $product['product']->name,
          'price' => $product['product']->price,
          'quantity' => $product['quantity']
        ])
        @endcomponent
      @endforeach
    </tbody>
  </table>

  <div>Összesen: {{ $priceTotal }}</div>

  <a href="{{ url('pay') }}">Megrendelés</a>
</div>
@endsection
