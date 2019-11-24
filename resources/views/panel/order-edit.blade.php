@extends('layouts.panel')

@section('title', 'Order Details')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Termékek</h1>
</div>

<div class="row">
  @foreach($orderProducts as $orderProduct)
    <div class="col-lg-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div><b>{{ $orderProduct->product->name }}</b></div>

          <div style="position: relative; padding-bottom: 100%; width: 100%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ url($orderProduct->product->product_variant_default->base_product_variant->getFirstMediaUrl('base_product_variant', 'thumb')) }}')">
            <div style="position: absolute; width: {{ $orderProduct->product->product_variant_default->base_product_variant->base_product_zone->width }}%; height: {{ $orderProduct->product->product_variant_default->base_product_variant->base_product_zone->height }}%; left: {{ $orderProduct->product->product_variant_default->base_product_variant->base_product_zone->left }}%; top: {{ $orderProduct->product->product_variant_default->base_product_variant->base_product_zone->top }}%;">
              <img src="{{ url($orderProduct->product->product_variant_default->design_image['thumb']) }}" style="position: absolute; width: {{ $orderProduct->product->product_variant_default->design_width }}%; left: {{ $orderProduct->product->product_variant_default->design_left }}%; top: {{ $orderProduct->product->product_variant_default->design_top }}%;">
            </div>
          </div>

          <div>Termék: <b>{{ $orderProduct->product->base_product_name }}</b></div>
          <div>Szín: <b>{{ $orderProduct->product->product_variant_default->base_product_variant->base_product_color->name }}</b></div>
          <div>Darab: <b>{{ $orderProduct->quantity }}</b></div>
          <div><a href="{{ url($orderProduct->product->product_variant_default->design_image['original']) }}">Minta letöltése</a></div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Adatok</h1>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Ár</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Termékek</td>
              <td>{{ number_format($order->product_price, 0, ',', ' ') }} Ft</td>
            </tr>
            <tr>
              <td>Szállítás</td>
              <td>{{ number_format($order->shipping_price, 0, ',', ' ') }} Ft</td>
            </tr>
            <tr>
              <td><b>Összesen</b></td>
              <td><b>{{ number_format($order->total_price, 0, ',', ' ') }} Ft</b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Szállítás</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td><b>Átvételi mód</b></td>
              <td>{{ $shippingData['shipping_method_text'] }}</td>
            </tr>
            <tr>
              <td><b>Fizetési mód</b></td>
              <td>{{ $paymentData['payment_method_text'] }}</td>
            </tr>
            <tr>
              <td><b>Név</b></td>
              <td>{{ $shippingData['name'] }}</td>
            </tr>
            <tr>
              <td><b>Irányítószám</b></td>
              <td>{{ $shippingData['zip'] }}</td>
            </tr>
            <tr>
              <td><b>Város</b></td>
              <td>{{ $shippingData['city'] }}</td>
            </tr>
            <tr>
              <td><b>Cím</b></td>
              <td>{{ $shippingData['address'] }} <a target="_blank" href="https://www.google.com/maps/search/{{ $shippingData['zip'] }}, {{ $shippingData['city'] }} {{ $shippingData['address'] }}">[Térkép]</a></td>
            </tr>
            <tr>
              <td><b>E-mail cím</b></td>
              <td>{{ $shippingData['email'] }}</td>
            </tr>
            <tr>
              <td><b>Telefonszám</b></td>
              <td>{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</td>
            </tr>
            <tr>
              <td><b>Megjegyzés a szállítással kapcsolatban</b></td>
              <td>{{ $shippingData['comment'] ? $shippingData['comment'] : '---' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Számlázás</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td><b>Név</b></td>
              <td>{{ $billingData['name'] }}</td>
            </tr>
            <tr>
              <td><b>Irányítószám</b></td>
              <td>{{ $billingData['zip'] }}</td>
            </tr>
            <tr>
              <td><b>Város</b></td>
              <td>{{ $billingData['city'] }}</td>
            </tr>
            <tr>
              <td><b>Cím</b></td>
              <td>{{ $billingData['address'] }}</td>
            </tr>
            <tr>
              <td><b>E-mail cím</b></td>
              <td>{{ $billingData['email'] }}</td>
            </tr>
            <tr>
              <td><b>Telefonszám</b></td>
              <td>{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 3,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
