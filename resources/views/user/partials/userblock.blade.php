<div class="d-flex">
  <div class="flex-shrink-0">
    <img src="/" alt="{{ $user->getNameOrUsername() }}">
  </div>
  <div class="flex-grow-1 ms-3">
      <a href="#"> {{ $user->getNameOrUsername() }}</a>
      @if ($user->location)
          <p>{{$user->location}}</p>
      @endif
  </div>
</div>
