<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NotfallzugriffController extends Controller
{

    function index(Request $request)
    {
        return Inertia::render('Notfallzugriff/Show');

    }


    public function checkPersonalnummer(Request $request) {

        $personalnummer =  $request->input('personalnummer');

        if (User::where('personalnummer', '=', $personalnummer)->exists()) {
            return Inertia::render('Notfallzugriff/Pin', [
                'user' => User::where('personalnummer', '=', $personalnummer)->get()
            ]);
        } else {
            return Redirect::route('login')->with('error', 'Benutzer exsistiert nicht.');
        }

    }

    public function checkPin(Request $request) {


        dd($request->input());


        User::find($request->id);
        User::find($request->id);

        Auth::login($request->id);

        //check if user has pin = pin->request
        //true = login user
        //false = error message

    }

}
