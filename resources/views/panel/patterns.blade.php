<h1>PATTERNS</h1>

<h2>Upload Patterns</h2>

<form id="pattern-upload-form" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="submit">
<!--
    <script>
        const form = document.getElementById('pattern-upload-form');
        const request = new XMLHttpRequest();

        form.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(form);

            request.open('post', '{{ route('panel.patterns.upload') }}');
            request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            request.send(formData);
        });
    </script> -->
</form>

<h2>List Patterns</h2>

@foreach($patterns as $pattern)
    @component('panel.components.pattern', [
        'id' => $pattern->id,
        'name' => $pattern->name,
        'url' => url($pattern->getFirstMediaUrl('patterns'))
    ])
    @endcomponent
@endforeach
