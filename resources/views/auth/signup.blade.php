@extends('templates.base')

@section('content')
<div class="row">
  <div class="col-lg-4 mx-auto">
    <h1>Регистрация</h1>
    <form method="POST" action="{{ route('auth.signup') }}" novalidate>
      @csrf

      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <!-- Поле с ошибкой подсвечивается, в поле value прошлые данные сохраняются-->
        <input type="email" name="email"
              class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}" id="email"
              placeholder="К примеру : test@email.com"
              value="{{ Request::old('email') ?: ''}}">
        <!-- ВЫВОД ОШИБКИ -->
        @if ($errors->has('email'))
          <span class="help block text-danger">
            {{ $errors->first('email')}}
          </span>
        @endif
      </div>
      
      <div class="form-group">
        <label for="exampleInputEmail1">Логин</label>
        <input type="text" name="username"
              class="form-control{{ $errors->has('username') ? ' is-invalid' : ''}}" id="username"
              placeholder="Введите Ваш логин"
              value="{{ Request::old('username') ?: ''}}">

        <!-- ВЫВОД ОШИБКИ -->
        @if ($errors->has('username'))
          <span class="help block text-danger">
            {{ $errors->first('username')}}
          </span>
        @endif
      </div>

      <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" name="password"
              class="form-control{{ $errors->has('password') ? ' is-invalid' : ''}}" id="password"
              placeholder="Минимум 6 символов">
        <!-- ВЫВОД ОШИБКИ -->
        @if ($errors->has('password'))
          <span class="help block text-danger">
            {{ $errors->first('password')}}
          </span>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Создать аккаунт</button>
    </form>
  </div>
</div>
@endsection
