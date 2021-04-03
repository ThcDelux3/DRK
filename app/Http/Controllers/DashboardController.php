<?php

namespace App\Http\Controllers;

use App\Models\Lager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{

    function index(Request $request)
    {

        //get all Notfallzugriffe from DB with Vor und Nachname and Zugriffszeit
        $notfallzugriffe = DB::table('notfallzugriff')->get();
        $notfalzugriffe_array = [];

        foreach ($notfallzugriffe as $notfallzugriff) {

            $zugriffsdatum = date('d.m.Y H:i:s' , strtotime($notfallzugriff->created_at));
            $vorNachname = User::find($notfallzugriff->userId)->vorname . ' ' . User::find($notfallzugriff->userId)->nachname;

            array_push($notfalzugriffe_array, (object)[
                'zugriffszeit' => $zugriffsdatum,
                'name' => $vorNachname,
            ]);

        }

        return Inertia::render('Dashboard', [
            //Zeigt alle abgelaufenen Gegenstände im Lager an
            'sanlager_abgelaufen' => Lager::where('ablaufdatum', '<', today())->get(),
            //Zeigt alle Gegenstände an die nachbestellt werden sollten
            'sanlager_nachfuellen' => Lager::where('anzahl', '<=', 1)->get(),
            //Zeigt alle Notfallzugriffe an
            'sanlager_notfallzugriff' =>  $notfalzugriffe_array
        ]);

    }

}
