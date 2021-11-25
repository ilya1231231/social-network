<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index', [
            'friends' =>$friends,
            'requests' =>$requests
        ]);
    }

    public function getAdd($username)
    {
         $user = User::where('username', $username)->first();

         //если пользователь не найден через ссылку,то редиректим на началную страницу с сообщением
         if (!$user) {
             return redirect()->route('home')->with('info', 'Пользователь не найден!');
         }

         //Проверка на случай если пользователь попытается отправить запрос с адресной строки и с вьюшки 2 раза
         //Повторно отправить нельзя
         if (Auth::user()->hasFriendRequestPending($user)
            || $user->hasFriendRequestPending( Auth::user() ) ){
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Пользователю отправлен запрос в друзья');
            }
        //Проверка, чтобы через ссылку нельзя было себя добавить в друзья
         if (Auth::user()->id === $user->id){
             return redirect()->route('home');
         }
         //проверка если пользователь уже в друзьях
         if (Auth::user()->isFriendWith($user)){
           return redirect()
              ->route('profile.index', ['username' => $user->username])
              ->with('info', 'Пользователь уже в друзьях');
         }

         Auth::user()->addFriend($user);

         return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Заявка в друзья отправлена');
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        //если пользователь не найден через ссылку,то редиректим на началную страницу с сообщением
        if (!$user) {
            return redirect()->route('home')->with('info', 'Пользователь не найден!');
        }

        if (! Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
           ->route('profile.index', ['username' => $username])
           ->with('info', 'Заявка в друзья принята');
    }

}
