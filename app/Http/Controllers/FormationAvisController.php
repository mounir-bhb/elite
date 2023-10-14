<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Commentaire;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FormationAvisController extends Controller
{
    public function store(Request $request){
        //dd($request);
        $user_id= auth()->user()->id;
        $formation= Formation::find($request->formation_id);
        if(Gate::allows('interact', [Inscription::class, $formation])){
            if($request->avis_id){
                $avis=Avis::find($request->avis_id);
            }
            else
                $avis= new Avis();
            $avis->user_id= $user_id;
            $avis->valeur=$request->star;
            $formation->avis()->save($avis);
            if($avis->commentaire){
                $commentaire= Commentaire::find($avis->commentaire->id);
                $commentaire->user_id= $user_id;
                $commentaire->avis_id= $avis->id;
                $commentaire->contenu =  $request->commentaire;
                $formation->commentaires()->save($commentaire);
            }
                
            else if($request->commentaire){
                $commentaire= new Commentaire();
                $commentaire->user_id= $user_id;
                $commentaire->avis_id= $avis->id;
                $commentaire->contenu =  $request->commentaire;
                $formation->commentaires()->save($commentaire);
            }
        }
        
    }
}
