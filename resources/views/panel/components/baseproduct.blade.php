<div style="display: inline-block; vertical-align: top; padding: 32px; border: 1px solid #000">
    <h3>{{ $baseProduct->name }}</h3>
    <img src="{{ $baseProduct->base_product_view_default['base_product_image'] }}" alt="{{ $baseProduct->name }}" width="200">
    <a href="{{ route('panel.baseproducts.delete', $baseProduct->id) }}">Delete</a>

    <form method="post" action="{{ route('panel.baseproducts.rename', $baseProduct->id) }}">
        @csrf
        <input type="text" name="name" value="{{ $baseProduct->name }}">
        <input type="submit">
    </form>
</div>
