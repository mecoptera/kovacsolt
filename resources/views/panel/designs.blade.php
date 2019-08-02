<h1>DESIGNS</h1>

<h2>Upload Designs</h2>

<form id="design-upload-form" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="submit">
<!--
    <script>
        const form = document.getElementById('design-upload-form');
        const request = new XMLHttpRequest();

        form.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(form);

            request.open('post', '{{ route('panel.designs.upload') }}');
            request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            request.send(formData);
        });
    </script> -->
</form>

<h2>List designs</h2>

@foreach($designs as $design)
    @component('panel.components.design', [ 'design' => $design ]) @endcomponent
@endforeach
