@extends('layouts.page')

@section('title', 'Felhasználói beálltások')

@section('content')
<div class="l-container l-container--smaller l-container--padding">
  <k-input data-placeholder="Példa: +36 20 310 6106" data-label="Telefonszám" data-value="Some predefined value" data-helper="Nem kötelező kitölteni"></k-input>
  <k-select>
    <k-select-option data-value="sadsd">Option 1</k-select-option>
  </k-select>
</div>
@endsection
