<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
        $user = User::where('username', $username)->first();

        if(!$user){
            //воводим 404 ошибку если пользователь не найден
            abort(404);
        }

        return view('profile.index', compact('user'));
        // Аналог верхнего кода
        // return view('profile.index')->with('user', $user);
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|alpha|max:255',
            'last_name' => 'required|alpha|max:20|min:2',
            'location' => 'required'
        ]);

        //Обновляем данные у аутентифицированного пользователя
        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location')
        ]);

        return redirect()
                  ->route('profile.edit')
                  ->with('info', 'Данные успешно изменены');
    }
}
