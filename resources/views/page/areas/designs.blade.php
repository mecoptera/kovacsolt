<form class="">
@foreach($designs as $design)
  <label class="">
    <input type="radio" name="design" class="" value="{{ $design->id }}" url="{{ url($design->getFirstMediaUrl('design')) }}">
    <img class="u-w-48 u-h-48" src="{{ url($design->getFirstMediaUrl('design')) }}" alt="{{ $design->name }}">
    <span class=""></span>
  </label>
@endforeach
</form>
