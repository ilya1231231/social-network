<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, AuthController, SearchController, ProfileController};


Route::get('/', [HomeController::class, 'index'])->name('home');
//Не даем попасть пользователю на ту страницу ,на которую он попасть не может(см. middleware:Authenticate RedirectifAuthentificated)
//регистрация
//Вход и регистрация только для гостей(middleware('guest'))
Route::get('/signup', [AuthController::class, 'getSignup'])->middleware('guest')->name('auth.signup');
Route::post('/signup', [AuthController::class, 'postSignup'])->middleware('guest');

//авторизация
//Вход и регистрация только для гостей(middleware('guest'))
Route::get('/signin', [AuthController::class, 'getSignin'])->middleware('guest')->name('auth.signin');
Route::post('/signin', [AuthController::class, 'postSignin'])->middleware('guest');

//выйти

Route::get('/signout', [AuthController::class, 'signOut'])->name('auth.signout');

//Поиск
Route::get('/search', [SearchController::class, 'getResults'])->name('search.results');

//Профиль пользователя
Route::get('/user/{username}', [ProfileController::class, 'getProfile'])->name('profile.index');

//Редактирование профиля
//Разрешается только аутентифициорванному пользователю
Route::get('/profile/edit', [ProfileController::class, 'getEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'postEdit'])->middleware('auth')->name('profile.edit');
