<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{

    function index(Request $request)
    {


        $result = User::where(DB::raw('concat(vorname," ",nachname)') , 'LIKE' , '%' . $request->input('query') . '%')
            ->orWhere(DB::raw('concat(nachname," ",vorname)') , 'LIKE' , '%' . $request->input('query') . '%')
            ->take(5)->get();

        return response()->json($result);

    }


}
