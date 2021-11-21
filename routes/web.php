<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{HomeController, AuthController, SearchController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


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
