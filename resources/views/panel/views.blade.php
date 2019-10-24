<h1>PRODUCT VIEWS</h1>

<h2>Upload Views</h2>

<form id="design-upload-form" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="submit">
</form>

<h2>List views</h2>

@foreach($views as $view)
    @component('panel.components.view', [ 'view' => $view ]) @endcomponent
@endforeach
