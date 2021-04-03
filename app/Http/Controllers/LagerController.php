<?php

namespace App\Http\Controllers;

use App\Models\Lager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class LagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Lager/Show', ['lager' => Lager::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Lager/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Lager::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'ablaufdatum' => ['required', 'max:50',],
                'anzahl' => ['required', 'max:50'],
                'schrank' => ['required', 'max:50'],
                'img' => ['required', 'max:50'],
            ])
        );

        return Redirect::route('lager')->with('success', 'Artikel erfolgreich erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lager  $lager
     * @return \Inertia\Response
     */
    public function edit(Lager $lager)
    {
        return Inertia::render('Lager/Edit', [
            'lager' => [
                'id' => $lager->id,
                'name' => $lager->name,
                'ablaufdatum' => $lager->ablaufdatum,
                'anzahl' => $lager->anzahl,
                'schrank' => $lager->schrank,
                'img' => $lager->img,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lager  $lager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Lager $lager)
    {
        $lager->update(
            Request::validate([
                'name' => ['required', 'max:50'],
                'ablaufdatum' => ['required', 'max:50'],
                'anzahl' => ['required', 'max:50'],
                'schrank' => ['required', 'max:50'],
                'img' => ['required', 'max:50'],
            ])
        );

        return Redirect::route('lager')->with('success', 'Artikel erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lager  $lager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Lager $lager)
    {
        $lager->delete();

        return Redirect::route('lager')->with('success', 'Artikel erfolgreich gelöscht.');
    }

    public function NotfallZugriff(Request $request) {

        $personal_nummer = Auth::user()->personalnummer;

        if (User::where('personalnummer', '=', $personal_nummer)->exists()) {

            DB::table('notfallzugriff')->insert(
                array(
                    'userId'     =>  Auth::user()->id,
                    'created_at'   =>   date('Y-m-d H:i:s'),
                )
            );

            return Inertia::render('Lager/showcode');
        } else {
            return Inertia::render('Lager');
        }
    }

}
