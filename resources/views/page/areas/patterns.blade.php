<form class="c-patterns">
@foreach($patterns as $pattern)
  <label class="c-patterns__item">
    <input type="radio" name="pattern" class="c-patterns__input" value="{{ $pattern->id }}" url="{{ url($pattern->getFirstMediaUrl('patterns')) }}">
    <img class="c-patterns__image" src="{{ url($pattern->getFirstMediaUrl('patterns')) }}" alt="{{ $pattern->name }}">
    <span class="c-patterns__checked"></span>
  </label>
@endforeach
</form>
