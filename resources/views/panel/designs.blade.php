<h1>DESIGNS</h1>

<h2>Upload Designs</h2>

<form id="design-upload-form" method="post" action="{{ route('panel.designs.upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="text" name="name" value="">
    <input type="submit">
</form>

<h2>List designs</h2>

@foreach($designs as $design)
    @component('panel.components.design', [ 'design' => $design ]) @endcomponent
@endforeach
