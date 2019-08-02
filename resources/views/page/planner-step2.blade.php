@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <section class="l-container">
    @yield('steps')

    <k-planner data-zone-width="40" data-zone-height="60" data-zone-left="30.5" data-zone-top="20" data-area-url="{{ route('page.planner.area') }}/"></k-planner>
  </section>
@endsection
