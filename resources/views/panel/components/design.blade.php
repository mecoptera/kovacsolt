<div style="display: inline-block; vertical-align: top; padding: 32px; border: 1px solid #000">
    <h3>{{ $design->name }}</h3>
    <img src="{{ url($design->getFirstMediaUrl('design')) }}" alt="{{ $design->name }}" width="200">
    <a href="{{ route('panel.designs.delete', $design->id) }}">Delete</a>

    <form method="POST" action="{{ route('panel.designs.rename', $design->id) }}">
        @csrf
        <input type="text" name="name">
        <input type="submit">
    </form>
</div>
