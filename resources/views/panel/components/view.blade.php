<div style="display: inline-block; vertical-align: top; padding: 32px; border: 1px solid #000">
    <h3>{{ $view->name }}</h3>
    <img src="{{ url($view->getFirstMediaUrl('product')) }}" alt="{{ $view->name }}" width="200">
    <a href="{{ route('panel.views.delete', $view->id) }}">Delete</a>

    <form method="POST" action="{{ route('panel.views.rename', $view->id) }}">
        @csrf
        <input type="text" name="name">
        <input type="submit">
    </form>
</div>
