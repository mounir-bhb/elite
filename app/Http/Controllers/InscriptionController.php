<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionRefuser;
use App\Mail\InscriptionValider;
use App\Models\Admin;
use App\Models\Ccp;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\QuizInscription;
use App\Models\Revenu;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class InscriptionController extends Controller
{
    public function inscription(Request $request){
        $formation= Formation::find($request->formation_id);
        if(Gate::allows('createformation', [Inscription::class, $formation])){
            $inscrition= new Inscription();
            $inscrition->student_id= auth()->user()->roleable_id;
            $inscrition->formation_id= $request->formation_id;
            $inscrition->price_id= $request->price;
            $inscrition->save();
            $ccp= new Ccp();
            $ccp->image_url=$request->file('image_ccp')->store('ccp','public');
            $inscrition->ccps()->save($ccp);
        }
    }
    public function quizInscription(Request $request){
        $inscrition= new QuizInscription();
        $inscrition->student_id= auth()->user()->roleable_id;
        $inscrition->price_id= $request->price;
        $inscrition->save();
        $ccp= new Ccp();
        $ccp->image_url=$request->file('image_ccp')->store('ccp','public');
        $inscrition->ccps()->save($ccp);
    }
    public function validation(Request $request){
        //dd($request->inscription);
        if(Gate::allows('administrate', Admin::class)){
            $inscription= Inscription::find($request->inscription['id']);
            $inscription->valide= true;
            $inscription->update();
            $revenu= new Revenu();
            $revenu->montant= ($inscription->price->price * 20)/100;
            $revenu->recette= $inscription->price->price;
            $revenu->save();
            Mail::to($inscription->student->user->email)->send(new InscriptionValider());
        }
    }
    public function quizValidation(Request $request){
        if(Gate::allows('administrate', Admin::class)){
            $inscrition= QuizInscription::find($request->inscription['id']);
            $inscrition->is_valide= true;
            $inscrition->update();
            Mail::to($inscrition->student->user->email)->send(new InscriptionValider());
        }
    }
    public function inscriptionRefus(Request $request){
        if(Gate::allows('administrate', Admin::class)){
            $inscription= Inscription::find($request->inscription['id']);
            Mail::to($inscription->student->user->email)->send(new InscriptionRefuser($request->wrong_msg));
            $inscription->delete();
        }
        
    }
    public function refuserQuizInscription(Request $request){
        if(Gate::allows('administrate', Admin::class)){
            $inscription= QuizInscription::find($request->inscription['id']);
            Mail::to($inscription->student->user->email)->send(new InscriptionRefuser($request->wrong_msg));
            $inscription->delete();
        }
        
    }
}
