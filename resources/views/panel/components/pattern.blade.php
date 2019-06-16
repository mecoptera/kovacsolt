<div style="display: inline-block; vertical-align: top; padding: 32px; border: 1px solid #000">
    <h3>{{ $name }}</h3>
    <img src="{{ $url }}" alt="{{ $name }}" width="200">
    <a href="{{ route('panel.patterns.delete', $id) }}">Delete</a>

    <form method="POST" action="{{ route('panel.patterns.rename', $id) }}">
        @csrf
        <input type="text" name="name">
        <input type="submit">
    </form>
</div>
