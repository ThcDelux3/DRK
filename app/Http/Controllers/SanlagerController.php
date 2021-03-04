<?php

namespace App\Http\Controllers;

use App\Models\Sanlager;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SanlagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sanlager  $sanlager
     * @return \Illuminate\Http\Response
     */
    public function show(Sanlager $sanlager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sanlager  $sanlager
     * @return \Illuminate\Http\Response
     */
    public function edit(Sanlager $sanlager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sanlager  $sanlager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanlager $sanlager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sanlager  $sanlager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sanlager $sanlager)
    {
        //
    }

    public function NotfallZugriff(Request $request) {

        $personal_nummer = $request->get('personalnummer');

        if (User::where('personalnummer', '=', $personal_nummer)->exists()) {
            // Personalnummer exsistiert


            //TODO Insert User in DB Notfallzugriff

            return Inertia::render('Sanlager/showcode');
        } else {
            echo 'User not found!';
        }

    }


}
