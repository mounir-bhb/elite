<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVideo;
use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\Formation;
use App\Models\Ressource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Queue;
use Inertia\Inertia;

class CourController extends Controller
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
        $chapitres= Chapitre::get();
        return Inertia::render('Cour/CreateCour', ['chapitres' => $chapitres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $chapitre= Chapitre::find($request->chapitre);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){
            $cour= new Cour();
            $cour->titre= $request->titre;
            $cour->resume= $request->resume;
            $cour->chapitre_id= $request->chapitre;
            $cour->gratuit= $request->gratuit;
            $cour->save();
            //session()->flash("success", "Le cours à été crée avec succès!");
            $video= Video::find($request->videoId);
            /* $video->cour_id= $cour->id; */
            /* $video->save(); */
            $cour->video()->save($video);
        }
        else 
        return abort(403);
        
        /* if($request->file('caption')){
            $video->caption=$request->file('caption')->store('video_captions','public');
        } */
        
        /* if($request->file('video_url'))
            $video->video_url= $request->file('video_url')->store('videos','public'); */
        /* foreach($request->pdf_files as $file){
            $ressource= new Ressource();
            $ressource->ressource_url= $file->store('ressources', 'public');
            $cour->ressources()->save($ressource);
        } */
    
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
        $chapitre= Chapitre::find($request->chapitre);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){
            $cour= Cour::find($id);
            $cour->titre= $request->titre;
            $cour->resume= $request->resume;
            $cour->chapitre_id= $request->chapitre;
            $cour->gratuit= $request->gratuit;
            $cour->save();
            if($request->videoId){
                $old_video= Video::find($cour->video->id);
                $old_video->delete();
                $video= Video::find($request->videoId);
                $cour->video()->save($video);
            }
        }
        
        //session()->flash("success", "Le cours à été crée avec succès!");
        
        /* $video->cour_id= $cour->id; */
        /* $video->save(); */
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cour= Cour::find($id);
        $chapitre= Chapitre::find($cour->chapitre_id);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){

        }
    }
}
