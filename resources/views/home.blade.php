@extends('templates.base')

@section('content')
  <div class="row">
    <div class="col-lg-6">
    <h1>Добро пожаловать</h1>
    <p>Вы находитесь в лучшей социальной сети!</p>
    <img class="phone" src="{{ asset('phone.jpg') }}" alt="Phone">
    </div>
  </div>
@endsection
