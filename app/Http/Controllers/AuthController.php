<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        User::create([
            'email'=> $request->input('email'),
            'username'=> $request->input('username'),
            'password'=> bcrypt($request->input('password')),   //Шифруем пароль через bycrypt
        ]);

        return redirect()
                ->route('home')
                ->with('info', 'Вы успешно зарегистрировались');
    }

    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        // Если не получается авторизоваться
        // only = сверяем только email и password
        // has=проверяем поставил ли пользователь галочку
        if(!Auth::attempt( $request->only(['email', 'password']), $request->has('remember') ))    //хешированный пароль сравнивается с password
        {
            return redirect()->back()->with('decline', 'Неправильный логин или пароль');
        }

        return redirect()->route('home')->with('info', 'Вы вошли на сайт');
    }

    public function signOut()
    {
        //метод класса auth ,который позволяет выйти из аккаунта
        Auth::logout();

        return redirect()->route('home')->with('info', 'Вы успешно вышли из аккаунта');
    }
}
