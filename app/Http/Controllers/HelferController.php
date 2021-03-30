<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class HelferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Helfer/Show', ['users' => User::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Helfer/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        Request::validate([
            'vorname' => ['required', 'max:50'],
            'nachname' => ['required', 'max:50'],
            'email' => ['max:50', 'email'],
            'organisation' => ['required', 'max:50'],
            'geburtsdatum' => ['date'],
            'personalnummer' => ['required'],
            'qualifikation' => ['max:50'],
            'password' => ['max:50'],
        ]);

        User::create([
            'vorname' => Request::get('vorname'),
            'nachname' => Request::get('nachname'),
            'email' => Request::get('email'),
            'organisation' => Request::get('organisation'),
            'geburtsdatum' => Request::get('geburtsdatum'),
            'personalnummer' => Request::get('personalnummer'),
            'qualifikation' => Request::get('qualifikation'),
            'password' => Request::get('password'),
        ]);

        return Redirect::route('helfer')->with('success', 'Helfer erfolgreich erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {

        return Inertia::render('Helfer/Edit', [
            'user' => [
                'id' => $user->id,
                'vorname' => $user->vorname,
                'nachname' => $user->nachname,
                'email' => $user->email,
                'qualifikation' => $user->qualifikation,
                'geburtsdatum' => $user->geburtsdatum,
                'organisation' => $user->organisation,
                'personalnummer' => $user->personalnummer,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Helfer  $user
     * @return
     */
    public function update(User $user)
    {
        Request::validate([
            'vorname' => ['required', 'max:50'],
            'nachname' => ['required', 'max:50'],
            'email' => ['max:50', 'email'],
            'organisation' => ['required', 'max:50'],
            'geburtsdatum' => ['date'],
            'personalnummer' => ['required'],
            'qualifikation' => ['max:50'],
        ]);


        $user->update(Request::only('vorname', 'nachname', 'email', 'organisation', 'geburtsdatum', 'personalnummer', 'qualifikation'));

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::route('helfer')->with('success', 'Helfer erfolgreich aktualisiert.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('helfer')->with('success', 'Helfer erfolgreich gelöscht.');
    }
}
