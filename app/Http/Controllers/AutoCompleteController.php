<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    function index(Request $request)
    {


        $queries = DB::table('users')
            ->where('vorname', 'LIKE', '%'.$request->input('query').'%')
            ->orWhere('nachname', 'LIKE', '%'.$request->input('query').'%')
            ->take(5)->get();


        return response()->json($queries);

    }


}
