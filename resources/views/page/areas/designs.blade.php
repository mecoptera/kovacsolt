<form class="u-flex">
@foreach($designs as $design)
  <label class="u-p-8">
    <input type="radio" name="design" class="" value="{{ $design->id }}" url="{{ url($design->getFirstMediaUrl('design', 'planner')) }}">
    <div class="u-w-48 u-h-48 u-bg-contain u-bg-center u-bg-no-repeat" style="background-image: url({{ url($design->getFirstMediaUrl('design', 'thumb')) }});"></div>
    <span class="u-p-8">{{ $design->name }}</span>
  </label>
@endforeach
</form>
