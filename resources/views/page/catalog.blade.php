@extends('layouts.app')

@section('content')
<h1>Catalog</h1>
<div>
    @foreach($patterns as $pattern)
        @component('page.components.pattern', [
            'name' => $pattern->name,
            'url' => url($pattern->getFirstMediaUrl('patterns'))
        ])
        @endcomponent
    @endforeach
</div>
@endsection
