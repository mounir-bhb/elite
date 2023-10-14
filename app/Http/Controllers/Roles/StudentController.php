<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $student= new Student();
        if($request->file('photo_url'))
            $student->photo_url=$request->file('photo_url')->store('student','public');
        $student->date_naissance=$request->date_naissance;
        $student->sex=$request->sex;
        $student->tel=$request->tel;
        $student->annee_id= $request->annee['id'];
        $student->filiere_id= $request->filiere['id'];
        $student->cycle_id= $request->cycle['id'];
        $student->save();

        $student->user()->save($user);
        return redirect()->route('formation.index');
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
        $student= Student::find($id);
        if($request->file('photo_url'))
            $student->photo_url=$request->file('photo_url')->store('student','public');
        $student->date_naissance=$request->date_naissance;
        $student->sex=$request->sex;
        $student->tel=$request->tel;
        $student->annee_id= $request->annee;
        $student->filiere_id= $request->filiere;
        $student->cycle_id= $request->cycle;
        $student->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
