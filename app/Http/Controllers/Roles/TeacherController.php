<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user= User::find(auth()->user()->id);
        $teacher= new Teacher();
        if($request->file('photo_url'))
            $teacher->photo_url=$request->file('photo_url')->store('teachers_pic','public');
        $teacher->date_naissance=$request->date_naissance;
        $teacher->sex= $request->sex;
        $teacher->tel=$request->tel;
        $teacher->rib=$request->rib;
        $teacher->description=$request->description;
        $teacher->save();
        $teacher->user()->save($user);
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
        $teacher= Teacher::find($id);
        if($request->file('photo_url'))
            $teacher->photo_url=$request->file('photo_url')->store('teachers_pic','public');
        $teacher->date_naissance=$request->date_naissance;
        $teacher->sex= $request->sex;
        $teacher->tel=$request->tel;
        $teacher->rib=$request->rib;
        $teacher->description=$request->description;
        $teacher->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
