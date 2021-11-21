@extends('templates.base')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <h1>Редактирование профиля</h1>

    <form method="POST" action="{{ route('profile.edit') }}" novalidate>
      @csrf
        <div class="form-group">
          <label for="first_name">Ваше имя</label>
          <!-- Поле с ошибкой подсвечивается, в поле value прошлые данные сохраняются-->
          <input type="text" name="first_name"
                class="form-control{{ $errors->has('first_name') ? ' is-invalid' : ''}}" id="first_name"
                value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
          <!-- ВЫВОД ОШИБКИ -->
          @if ($errors->has('first_name'))
            <span class="help block text-danger">
              {{ $errors->first('first_name')}}
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="last_name">Ваша фамилия</label>
          <input type="text" name="last_name"
                class="form-control{{ $errors->has('last_name') ? ' is-invalid' : ''}}" id="last_name"
                value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
          <!-- ВЫВОД ОШИБКИ -->
          @if ($errors->has('last_name'))
            <span class="help block text-danger">
              {{ $errors->first('last_name')}}
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="location">Страна</label>
          <input type="text" name="location"
                class="form-control{{ $errors->has('location') ? ' is-invalid' : ''}}" id="location"
                value="{{ Request::old('location') ?: Auth::user()->location }}">
          <!-- ВЫВОД ОШИБКИ -->
          @if ($errors->has('location'))
            <span class="help block text-danger">
              {{ $errors->first('location')}}
            </span>
          @endif
        </div>

      <button type="submit" class="btn btn-primary">Обновить профиль</button>
    </form>
  </div>
</div>
@endsection
