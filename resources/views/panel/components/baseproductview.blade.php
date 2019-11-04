<div style="display: inline-block; vertical-align: top; padding: 32px; border: 1px solid #000">
    <h3>{{ $view->base_product_id }} {{ $view->name }}</h3>
    <img src="{{ url($view->getFirstMediaUrl('product')) }}" alt="{{ $view->name }}" width="200">
    <a href="{{ route('panel.baseproductviews.default', $view->id) }}">Default</a>
    <a href="{{ route('panel.baseproductviews.delete', $view->id) }}">Delete</a>

    <form method="post" action="{{ route('panel.baseproductviews.rename', $view->id) }}">
        @csrf
        <input type="text" name="name" value="{{ $view->name }}">
        <input type="submit">
    </form>
</div>
