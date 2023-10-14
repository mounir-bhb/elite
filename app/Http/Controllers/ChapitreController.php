<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ChapitreController extends Controller
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
    public function create($id)
    {
        
        return Inertia::render('Chapitre/CreateChapitre', ['formation_id'=> $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formation= Formation::find($request->formation_id);
        if(Gate::allows('update', $formation)){
            $chapitre= new Chapitre();
            $chapitre->formation_id=$request->formation_id;
            $chapitre->titre= $request->titre;
            $chapitre->save();
            return redirect()->route('formation.show', [$request->formation_id]);
        }
        else
            return abort(403);
        
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
        $chapitre = Chapitre::findOrFail($id);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){
            $chapitre->delete();
        }
    }
}
