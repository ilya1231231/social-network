@extends('templates.base')

@section('content')
  <div class="row">

    <div class="col-lg-6">
        <h3>Ваши друзья</h3>
        @if(!$friends->count())
          <p>У вас нет друзей<p>
        @else
          @foreach($friends as $user)
            @include('user.partials.userblock')
          @endforeach
        @endif
    </div>

    <div class="col-lg-6">
        @if(!$requests->count())
          <p>У вас нет заявок в друзья<p>
        @else
        <h3>Заявки в друзья</h3>
          @foreach($requests as $user)
            @include('user.partials.userblock')
          @endforeach
        @endif
    </div>

  </div>
@endsection
