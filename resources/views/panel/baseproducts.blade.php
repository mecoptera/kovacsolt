<h1>BASE PRODUCTS</h1>

<h2>Upload Views</h2>

<form method="post" enctype="multipart/form-data" action="{{ route('panel.baseproducts.upload') }}">
    @csrf
    <input type="text" name="name" value="">
    <input type="submit">
</form>

<h2>List views</h2>

@foreach($baseProducts as $baseProduct)
    @component('panel.components.baseproduct', [ 'baseProduct' => $baseProduct ]) @endcomponent
@endforeach
