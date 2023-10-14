<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\CourQuestion;
use App\Models\Formation;
use App\Models\ForumSujet;
use App\Models\Inscription;
use App\Models\Like;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function questionCour(Request $request){
        $formation= Formation::find($request->id);
        if(Gate::allows('interact', [Inscription::class ,$formation])){
            $sujet= new CourQuestion();
            $sujet->user_id= auth()->user()->id;
            $sujet->formation_id= $request->id;
            $sujet->cour_id= $request->selected_cour;
            $sujet->question= $request->question;
            $sujet->save();
        }
        
    }

    public function reponseCour(Request $request) {
        $formation= Formation::find($request->formation);
        if(Gate::allows('interact', [Inscription::class, $formation]) || Gate::allows('update', $formation)){
            $reponse= new Reponse();
            $question= CourQuestion::find($request->parent_id);
            $reponse->user_id= auth()->user()->id;
            $reponse->reponse= $request->reponse;
            $question->reponses()->save($reponse);
        }
    }
    public function reponseForum(Request $request){
        if(Gate::allows('surfe', Student::class)){
            $reponse= new Reponse();
            $question= ForumSujet::find($request->parent_id);
            $reponse->user_id= auth()->user()->id;
            $reponse->reponse= $request->reponse;
            $question->reponses()->save($reponse);
        }
        
    }
    public function reponse(Request $request){
        if($request->formation){
            $formation= Formation::find($request->formation);
            if(Gate::allows('interact', [Inscription::class, $formation]) || Gate::allows('update', $formation)){
                $prev_reponse= Reponse::find($request->parent_id);
                $reponse= new Reponse();
                $reponse->user_id= auth()->user()->id;
                $reponse->reponse= $request->reponse;
                $prev_reponse->reponses()->save($reponse);
            }
            else 
                return abort(403);
        }
        else {
            if(Gate::allows('surfe', Student::class) || Gate::allows('create', Teacher::class)){
                $prev_reponse= Reponse::find($request->parent_id);
                $reponse= new Reponse();
                $reponse->user_id= auth()->user()->id;
                $reponse->reponse= $request->reponse;
                $prev_reponse->reponses()->save($reponse);
            }
            else
                return abort(403);
            
        }
        
    }
    public function like(Request $request){
        
        if($request->formation){
            $formation= Formation::find($request->formation);
            if(Gate::allows('interact', [Inscription::class, $formation])){
                $like= new Like();
                $like->user_id= auth()->user()->id;
                $like->reponse_id= $request->reponse_id;
                $like->avis= $request->avis;
                $like->save();
            }
            else
                return abort(403);
        }
        else if(Gate::allows('surfe', Student::class) || Gate::allows('create', Teacher::class)){
            $like= new Like();
            $like->user_id= auth()->user()->id;
            $like->reponse_id= $request->reponse_id;
            $like->avis= $request->avis;
            $like->save();
        }
        else
            return abort(403);
            
    }

    public function deleteLike(Request $request){
        $like= Like::find($request->like);
        $like->delete();
    }

    public function valider(Request $request){
        $formation= Formation::find($request->formation);
        $this->authorize('update', $formation);
        $reponse= Reponse::find($request->reponse_id);
        $reponse->is_valid= true;
        $reponse->save();
    }

    public function annuleValidation(Request $request){
        $formation= Formation::find($request->formation);
        $this->authorize('update', $formation);
        $reponse= Reponse::find($request->reponse_id);
        $reponse->is_valid= false;
        $reponse->save();
    }
}
