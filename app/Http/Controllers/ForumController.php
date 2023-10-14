<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Formation;
use App\Models\ForumSujet;
use App\Models\Matiere;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ForumController extends Controller
{

    public function index(){
        $cycles= Cycle::with('filieres', 'annees')->get();
        $matieres= Matiere::all();
        $questions= ForumSujet::all();
        /* dd($cycles); */
        return Inertia::render('Forum/ForumIndex', [
            'cycles'=>$cycles,
            'matieres'=>$matieres,
            'questions'=>$questions
        ]);
    }

    public function create($formation_id, $cour_id){
        $formation= Formation::find($formation_id);
        $formation_titre= $formation->first('title');
        $formation_id= $formation->first('id');
        $chapitres= $formation->chapitres()->with('cours')->get();
        return Inertia::render('Forum/NewSujet', [
            'chapitres'=> $chapitres, 
            'cour_id'=> $cour_id, 
            'formation_titre'=> $formation_titre,
            'formation_id' => $formation_id
        ]);
    }

    public function store(Request $request){
        if(Gate::allows('create', Teacher::class) || Gate::allows('surfe', Student::class)){
            $sujet= new ForumSujet();
            $sujet->user_id= auth()->user()->id;
            $sujet->cycle_id= $request->cycle['id'];
            $sujet->filiere_id= $request->filiere['id'];
            $sujet->annee_id= $request->annee['id'];
            $sujet->matiere_id= $request->matiere['id'];
            $sujet->titre= $request->titre;
            $sujet->question= $request->question;
            $sujet->save();
        }
        

    }
}
