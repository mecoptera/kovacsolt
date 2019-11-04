<h1>BASE PRODUCT VIEWS</h1>

<h2>Upload Views</h2>

<form method="post" enctype="multipart/form-data" action="{{ route('panel.baseproductviews.upload') }}">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="text" name="name" value="">

    <select name="base_product_id">
      @foreach ($baseProducts as $baseProduct)
        <option value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</option>
      @endforeach
    </select>

    <input type="submit">
</form>

<h2>List views</h2>

@foreach($views as $view)
    @component('panel.components.baseproductview', [ 'view' => $view ]) @endcomponent
@endforeach
