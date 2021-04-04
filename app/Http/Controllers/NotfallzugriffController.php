<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
                'userdata' => User::where('personalnummer', '=', $personalnummer)->get()
            ]);
        } else {
            return Redirect::route('login')->with('error', 'Benutzer exsistiert nicht.');
        }

    }

    public function checkPin(Request $request) {

        //ToDo add error + Validarion            'pin' => ['required', 'integer', 'digits:6'],



        $pin = $request->input('pin');
        $userid = $request->input('userid');

        $user = User::find($userid);
        if($user) {
            if($user->pin == $pin && $pin != Null) {
                echo 'login';
                Auth::login($user);
                return Redirect::route('dashboard')->with('success', 'Erfolgreich Angemeldet');
            } else {
                echo 'Falsche pin';
            }

        } else {
            return Redirect::route('login')->with('error', 'Benutzer existiert nicht.');
        }
    }

}
