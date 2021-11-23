@extends('templates.base')

@section('content')
  <div class="row">
    <div class="col-lg-5">
      @include('user.partials.userblock')
    </div>

    <div class="col-lg-4 col-lg-offset-3">
      <!-- У пользователя отображается при добавлении кого-то в друзья -->
      @if ( Auth::user()->hasfriendRequestPending($user))
        <p>В ожидании {{ $user->getFirstNameOrUsername() }}
        подтверждения запроса в друзья </p>
      <!-- отображается у пользователя,которому кинули заявку в друзья(принять запрос или нет) -->
      @elseif ( Auth::user()->hasFriendRequestReceived($user) )
        <a href="#" class="btn btn-success">Подтвердить</a>
      <!-- Если он в друзьях,то будет при поиске отображаться это -->
      @elseif ( Auth::user()->isFriendWith($user))
        {{ $user->getFirstNameOrusername()}} у вас в друзьях.
      @else
        <a href="#" class="btn btn-success">Добавить в друзья</a>
      @endif
      <h4>Друзья пользователя {{ $user->getFirstNameOrUsername() }} </h4>
      <!-- Если нет друзей -->
      @if(!$user->friends()->count())
        <p>Нет друзей<p>
      @else
        @foreach($user->friends() as $user)
          @include('user.partials.userblock')
        @endforeach
      @endif

    </div>

  </div>
@endsection
