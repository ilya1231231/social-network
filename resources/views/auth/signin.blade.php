@extends('templates.base')

@section('content')
<div class="row">
  <div class="col-lg-4 mx-auto">
    <h1>Авторизация</h1>
    <!-- Автоматически вибирается метод пост в роутах -->
    <form method="POST" action="{{ route('auth.signin') }}" novalidate>
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
          <div class="form-check mb-3">
              <input name="remember"class="form-check-input" type="checkbox" value="" id="remember">
              <label class="form-check-label" for="remember">Запомнить меня</label>
      </div>

      <button type="submit" class="btn btn-primary">Войти</button>
    </form>
  </div>
</div>
@endsection
