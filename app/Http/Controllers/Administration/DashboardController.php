<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Mail\PaiementEnvoyer;
use App\Models\Admin;
use App\Models\Ccp;
use App\Models\Cycle;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Matiere;
use App\Models\Paiement;
use App\Models\QuizInscription;
use App\Models\Revenu;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        if(!$this->authorize('administrate', Admin::class))
            abort(403);
        else {
            $inscriptions= Inscription::with(['price', 'student.user', 'formation:id,title', 'ccps'])->where('valide',false)->get();
            $quizInscriptions= QuizInscription::with(['price', 'student.user', 'ccps'])->where('is_valide', false)->get();
            $teachers= Teacher::with(['user'])->get();
            $teachers->each(function ($teacher) {
                $totalPrice = $teacher->formations->flatMap(function ($formation) {
                    return $formation->inscriptions()->where('paid', false)
                        ->where('valide',true)
                        ->join('prices', 'inscriptions.price_id', '=', 'prices.id')
                        ->pluck('prices.price');
                })->sum();
            
                $teacher->totalPriceUnpaid = ($totalPrice*80)/100;
                $totalPrice = $teacher->formations->flatMap(function ($formation) {
                    return $formation->inscriptions()->where('paid', true)
                        ->where('valide',true)
                        ->join('prices', 'inscriptions.price_id', '=', 'prices.id')
                        ->pluck('prices.price');
                })->sum();
                $teacher->totalPricePaid = ($totalPrice*80)/100;
            });
            //dd($teachers);
            $paiements= Paiement::with(['teacher.user'])->get();
            $matieres= Matiere::all();
            $cycles= Cycle::with('filieres', 'annees')->get();
            /* $revenus= Revenu::all(); */
            /* $revenus= Revenu::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(montant) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get(); */
            $revenus = Revenu::selectRaw('UNIX_TIMESTAMP(DATE(created_at)) * 1000 as x, SUM(montant) as y')
                ->groupBy('x')
                ->orderBy('x')
                ->get();
            $totalRevenu= Revenu::sum('montant');
            $totalRecette= Revenu::sum('recette');
            $recette= Revenu::selectRaw('UNIX_TIMESTAMP(DATE(created_at)) * 1000 as x, SUM(recette) as y')
            ->groupBy('x')
            ->orderBy('x')
            ->get();
            $revenusQuiz= QuizInscription::with(['price', 'student.user'])->where('is_valide', true)->get();
            
            $formations= Formation::with(['teacher.user'])->where('is_valide', false)->get();
            
            /* $revenusQuiz= QuizInscription::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(montant) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get(); */
            //dd($revenus);
            return Inertia::render('Admin/AdminIndex', [
                'inscriptions'=>$inscriptions,
                'matieres'=> $matieres,
                'cycles'=> $cycles,
                'teachers'=> $teachers,
                'paiements'=>$paiements,
                'revenus'=> $revenus,
                'revenusQuiz'=>$revenusQuiz,
                'recette'=> $recette,
                'quizInscriptions' => $quizInscriptions,
                'formations' => $formations,
                'totalRevenu'=> $totalRevenu,
                'totalRecette' =>$totalRecette
            ]);
        }
        
    }
    public function paiement(Request $request){
        //return $request;
        if(!$this->authorize('administrate', Admin::class))
            abort(403);
        else {
            $teacher= Teacher::find($request->teacher);
            $paiement= new Paiement();
            $paiement->teacher_id= $request->teacher;
            $paiement->montant= $request->montant;
            $paiement->save();
            $ccp= new Ccp();
            $ccp->image_url=$request->file('ccp')->store('ccp','public');
            $paiement->ccps()->save($ccp);
            $teacher->formations->flatMap(function ($formation){
                $formation->inscriptions()
                ->where('valide', true)
                ->where('paid', false)
                ->each(function($inscription){
                    $inscription->paid= true;
                    $inscription->save();
                });
            });
            Mail::to($teacher->user->email)->send(new PaiementEnvoyer());
        }
        
        //return 'ok';
    }
}
