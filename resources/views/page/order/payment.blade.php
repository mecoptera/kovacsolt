@extends('page.order')

@section('title', 'Rendelés leadása')

@section('order-step')
  <h2 class="u-text-center">Fizetési mód</h2>

  <form class="l-form" method="post" action="{{ route('order.payment') }}">
    @csrf

    <div class="l-form__field">
      <k-select
        data-name="payment_method"
        data-label="Fizetési mód"
        data-placeholder="Válassz fizetési módot"
        @if (isset($paymentData['payment_method']))data-value="{{ $paymentData['payment_method'] }}"@endif
      >
        <k-select-option data-value="0">Személyesen, készpénzzel</k-select-option>
        <k-select-option data-value="1">Utánvétellel futárnak</k-select-option>
        <k-select-option data-value="2">Bankkártyás fizetés</k-select-option>
      </k-select>
    </div>

    <div class="l-form__field u-align-right">
      <input type="submit" class="c-button" value="Tovább a rendelés összesítéséhez">
    </div>
  </form>
@endsection
