<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\Formation;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RessourceController extends Controller
{
    public function store(Request $request, $id) {
        $cour= Cour::find($id);
        $chapitre= Chapitre::find($cour->chapitre_id);
        $formation= Formation::find($chapitre->formation_id);
        if(Gate::allows('update', $formation)){
            $ressource= new Ressource();
            $ressource->nom= $request->nom;
            $ressource->ressource_url= $request->pdf_file->store('ressources', 'public');
            $cour->ressources()->save($ressource);
        }
        
    }
    public function delete($id){
        $ressource= Ressource::find($id);
        $ressource->delete();
    }
}
