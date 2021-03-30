<?php

namespace App\Http\Controllers;

use App\Models\Fahrzeuge;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class FahrzeugeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Fahrzeuge/Show', ['fahrzeuge' => Fahrzeuge::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Fahrzeuge/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fahrzeuge::create(
            Request::validate([
                'funkrufname' => ['required', 'max:50'],
                'kennzeichen' => ['required', 'max:50', 'unique:fahrzeuges'],
                'fahrzeugart' => ['required', 'max:50'],
            ])
        );

        return Redirect::route('fahrzeuge')->with('success', 'Fahrzeug erfolgreich erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fahrzeuge  $fahrzeuge
     * @return \Inertia\Response
     */
    public function edit(Fahrzeuge $fahrzeuge)
    {
        return Inertia::render('Fahrzeuge/Edit', [
            'fahrzeuge' => [
                'id' => $fahrzeuge->id,
                'funkrufname' => $fahrzeuge->funkrufname,
                'kennzeichen' => $fahrzeuge->kennzeichen,
                'fahrzeugart' => $fahrzeuge->fahrzeugart,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fahrzeuge  $fahrzeuge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Fahrzeuge $fahrzeuge)
    {
        $fahrzeuge->update(
            Request::validate([
                'funkrufname' => ['required', 'max:50'],
                'kennzeichen' => ['required', 'max:50'],
                'fahrzeugart' => ['required', 'max:50'],

            ])
        );

        return Redirect::route('fahrzeuge')->with('success', 'Fahrzeug erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fahrzeuge  $fahrzeuge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fahrzeuge $fahrzeuge)
    {
        $fahrzeuge->delete();

        return Redirect::route('fahrzeuge')->with('success', 'Fahrzeug erfolgreich gelöscht.');
    }
}
