<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('query');
        //Если нет параметра-редиректим
        if (!$query)
        {
            redirect()->route('home');
        }
        //Ищем юзера в БД по имени и фамилии или по юзернейму,если их нет и сравниваем их с запросом
        $users = User::where(DB::raw("CONCAT (first_name, ' ', last_name)"),
                                      'LIKE', "%{$query}%")
                                      ->orWhere('username', 'LIKE', "%{$query}%")
                                      ->get();

        return view('search.results')->with('users', $users);
    }
}
