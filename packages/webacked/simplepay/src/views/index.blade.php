@extends('layouts.app')

@section('content')
<h1>Fizetési mód</h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ár</th>
      <th scope="col">Mennyiség</th>
    </tr>
  </thead>
  <tbody>
    @foreach($cart as $item)
      @component('cart::components.item', [
        'name' => $item['product']->name,
        'price' => $item['product']->price,
        'quantity' => $item['quantity']
      ])
      @endcomponent
    @endforeach
  </tbody>
</table>

<div>Összesen: {{ $priceTotal }}</div>

{!! $simplePayForm !!}
@endsection
