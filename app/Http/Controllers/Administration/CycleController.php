<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Annee;
use App\Models\Cycle;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cycle/CreateCycle');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* dd($request->filieres); */
        if(Gate::allows('administrate', Admin::class)){
            foreach($request->cycles as $cycle){
                $c= new Cycle();
                $c->nom= $cycle['nom'];
                $c->save();
                foreach($cycle['filieres'] as $filiere){
                    if($filiere['nom']){
                        $f= new Filiere();
                        $f->nom= $filiere['nom'];
                        $c->filieres()->save($f);
                    }
                    
                }
                foreach($cycle['annees'] as $annee){
                    if($annee['nom']){
                        $a= new Annee();
                        $a->nom= $annee['nom'];
                        $c->annees()->save($a);
                    }
                    
                }
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
