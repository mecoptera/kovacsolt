<form class="c-designs">
@foreach($designs as $design)
  <label class="c-designs__item">
    <input type="radio" name="design" class="c-designs__input" value="{{ $design->id }}" url="{{ url($design->getFirstMediaUrl('design')) }}">
    <img class="c-designs__image" src="{{ url($design->getFirstMediaUrl('design')) }}" alt="{{ $design->name }}">
    <span class="c-patterns__checked"></span>
  </label>
@endforeach
</form>
