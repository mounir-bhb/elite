<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Cycle;
use App\Models\Matiere;
use App\Models\Quiz;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TestController extends Controller
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
        $cycles= Cycle::with('filieres', 'annees')->get();
        $matieres= Matiere::all();
        return Inertia::render('Quiz/CreateTest', [
            'cycles'=> $cycles,
            'matieres'=>$matieres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Gate::allows('administrate', Admin::class))
            abort(403);
        else{
            $test= new Test();
            $test->cycle_id= $request->cycle['id'];
            $test->filiere_id= $request->filiere['id'];
            $test->annee_id= $request->annee['id'];
            $test->matiere_id= $request->matiere['id'];
            $test->titre= $request->titre;
            $test->save();
            return redirect()->route('create.level', [$test]);
        }
        
    }

    public function CreateLevel($test_id){
        if(!Gate::allows('administrate', Admin::class))
            abort(403);
        else{
            $test= Test::with('quizzes')->find($test_id);
            //dd($test);
            return Inertia::render('Quiz/CreateLevels', ['test'=>$test]);
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
