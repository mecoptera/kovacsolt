@extends('layouts.page')

@section('title', 'Felhasználói beálltások')

@section('content')
<div class="l-container l-container--smaller l-container--padding">
  <k-input data-disabled data-name="phone" data-value="Sample value" data-placeholder="Példa: +36 20 310 6106" data-label="Telefonszám" data-helper="Nem kötelező kitölteni"></k-input>

  <k-select data-disabled data-name="color" data-value="3" data-placeholder="Válassz egy színt" data-label="Szín" data-helper="Nem kötelező kitölteni">
    <k-select-option data-value="1">Op<i>ti</i>on 1</k-select-option>
    <k-select-option data-value="2">Option 2</k-select-option>
    <k-select-option data-value="3">Option 3</k-select-option>
    <k-select-option data-value="4">Option 4</k-select-option>
  </k-select>
</div>
@endsection
