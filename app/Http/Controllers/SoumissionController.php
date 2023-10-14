<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Quiz;
use App\Models\Ressource;
use App\Models\Soumission;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SoumissionController extends Controller
{
    public function courSoumission(Request $request){
        $formation= Formation::find($request->formation);
        if(Gate::allows('interact', [Inscription::class, $formation])){
            $user= auth()->user()->roleable_id;
            $cour= Cour::find($request->cour_id);
            if(!$cour->soumissions()->where('student_id', $user)->exists()){
                $soumission= new Soumission();
                $soumission->student_id= $user;
                $cour->soumissions()->save($soumission);
            }
            else {
                return 'already submitted';
            }   
        }
        else 
            return false;
    }

    public function ressourceSoumission(Request $request){
        
        if(Gate::allows('surfe', Student::class)){
            $user= auth()->user()->roleable_id;
            $ressource= Ressource::find($request->ressource_id);
            if(!$ressource->soumissions()->where('student_id', $user)->exists()){
                $soumission= new Soumission();
                $soumission->student_id= $user;
                $ressource->soumissions()->save($soumission);
            }
            else {
                return 'already submitted';
            }
        }
        else
            return false;
    }

    public function quizSoumission(Request $request){
        $permission= null;
        if($request->formation){
            $formation= Formation::find($request->formation);
            $permission= Gate::allows('interact', [Inscription::class, $formation]);
        }
        else
            $permission= Gate::allows('practice', Inscription::class);
        if($permission){
            $user= auth()->user()->roleable_id;
            $quiz= Quiz::find($request->quiz_id);
            if (!$quiz->soumissions()->where('student_id', $user)->exists()){
                $soumission= new Soumission();
                $soumission->student_id= $user;
                $quiz->soumissions()->save($soumission);
                return 'done';
            }
            else {
                return 'already submitted';
            }
        }
        else {
            return false;
        }
    }
}
