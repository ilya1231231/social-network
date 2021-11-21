@extends('templates.base')

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <h1>Результаты поиска : "{{ Request::input('query') }}" </h1>
      <!-- Если пользователи с такоими данными есть -->
      @if (!$users->count())
        <p>Пользователь не найден</p>
      @endif
        <div class="row">
            <div class="col-lg-6">
                @foreach ($users as $user)
                    @include('user.partials.userblock')
                @endforeach
            </div>
        </div>
    </div>
  </div>
@endsection
