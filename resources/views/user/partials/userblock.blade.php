<div class="d-flex mb-3">
  <div class="flex-shrink-0">
    <img src="https://prikolnye-kartinki.ru/img/picture/Dec/26/da0427eaeb205630073a623f37887ee4/1.jpg" width="80" height="auto" alt="{{ $user->getNameOrUsername() }}">
  </div>
  <div class="flex-grow-1 ms-3 ml-5">
      <!-- Получаем username через имя переменную $user и передаем username во вьюшку профиля -->
      <a href="{{ route('profile.index', ['username'=>$user->username])}}"> {{ $user->getNameOrUsername() }}</a>
      @if ($user->location)
          <p>{{$user->location}}</p>
      @endif
  </div>
</div>
