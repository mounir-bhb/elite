<?php

namespace App\Http\Controllers;

use App\Mail\FormationDesactivation;
use App\Mail\FormationValidation;
use App\Models\Admin;
use App\Models\Avis;
use App\Models\Cycle;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Matiere;
use App\Models\Paiement;
use App\Models\Price;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations= Formation::with('cycle','filiere', 'annee', 'matiere', 'teacher.user')->where('is_valide', true)->get();
        $cycles= Cycle::with('filieres', 'annees')->get();
        $matieres= Matiere::all();
        //dd($formations);
        return Inertia::render('Formation/FormationsIndex', [
            'formations' => $formations,
            'cycles'=>$cycles,
            'matieres'=>$matieres,
        ]);
    }

    public function studentFormations(){
        $user= auth()->user()->roleable_id;
        $formations= Inscription::with(['formation.cycle','formation.filiere', 'formation.annee', 'formation.matiere', 'formation.teacher.user'])->where('student_id', $user)->get();
        return Inertia::render('Student/StudentFormations', ['formations'=> $formations]);
    }
    
    public function TeacherFormations(){
        $user= auth()->user()->roleable_id;
        $valid_formations= Formation::where('teacher_id', $user)->where('is_valide', true)->get();
        $invalid_formations= Formation::with('cycle','filiere', 'annee', 'matiere', 'teacher.user')->where('teacher_id', $user)->where('is_valide', false)->get();
        $valid_formations->each(function($formation){
            
            $formation->nombre_inscri=$formation->inscriptions()->where('valide', true)->count();
            $formation->totalPriceUnpaid= ($formation->inscriptions()->where('paid', false)
            ->where('valide',true)
            ->join('prices', 'inscriptions.price_id', '=', 'prices.id')
            ->pluck('prices.price')
            ->sum()*80)/100;
            $formation->totalPricePaid= ($formation->inscriptions()->where('paid', true)
            ->where('valide',true)
            ->join('prices', 'inscriptions.price_id', '=', 'prices.id')
            ->pluck('prices.price')
            ->sum()*80)/100;
        });
        $totalPriceUnpaid= $valid_formations->sum('totalPriceUnpaid');
        $totalPricePaid= $valid_formations->sum('totalPricePaid');
        $nombre_inscri= $valid_formations->sum('nombre_inscri');
        $paiements= Paiement::where('teacher_id', $user)->get();
        
        return Inertia::render('Teacher/TeacherFormations', [
            'formations'=>$valid_formations,
            'invalid_formations'=> $invalid_formations,
            'totalPriceUnpaid'=>$totalPriceUnpaid,
            'totalPricePaid'=>$totalPricePaid,
            'nombre_inscri'=>$nombre_inscri,
            'paiements'=>$paiements
        ]);
    }

    public function details($id){
        /* $form=Formation::with(['prices'=> function($query){
            $query->where('is_active', true);
        }])->find($id);
        dd($form); */


        $formation= Formation::with(['cycle','filiere', 'annee', 'matiere', 'chapitres.cours', 'teacher.user', 'prices'=> function($query){
            $query->where('is_active', true);
        }])->find($id);
        $stars5= Formation::find($id)->avis()->where('valeur', 5)->get();
        $stars4= Formation::find($id)->avis()->where('valeur', 4)->get();
        $stars3= Formation::find($id)->avis()->where('valeur', 3)->get();
        $stars2= Formation::find($id)->avis()->where('valeur', 2)->get();
        $stars1= Formation::find($id)->avis()->where('valeur', 1)->get();
        $canUpdate= Gate::allows('update', $formation);
        $canInscrire= Gate::allows('createformation', [Inscription::class, $formation]);
        return Inertia::render('Formation/FormationDetails', [
            'formation'=> $formation,
            'canInscrire'=> $canInscrire,
            'canUpdate'=> $canUpdate,
            'stars5'=> $stars5,
            'stars4'=> $stars4,
            'stars3'=> $stars3,
            'stars2'=> $stars2,
            'stars1'=> $stars1,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('create', Teacher::class)){
        $cycles= Cycle::get();
        $matieres= Matiere::get();
        return Inertia::render('Formation/CreateFormation', ['cycles'=>$cycles, 'matieres'=>$matieres]);
        }
        else
            return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::allows('create', Teacher::class)){
            $formation= new Formation();
            $formation->title= $request->nom;
            $formation->teacher_id= auth()->user()->roleable_id;
            $formation->annee_id= $request->annee['id'];
            $formation->filiere_id= $request->filiere['id'];
            $formation->cycle_id= $request->cycle['id'];
            $formation->matiere_id= $request->matiere['id'];
            $formation->description= $request->description;
            $formation->a_apprendre= $request->a_apprendre;
            $formation->prerequis= $request->prerequis;
            $formation->a_propos= $request->a_propos;
            if($request->file("photo_url")){
                $formation->photo_url=$request->file('photo_url')->store('formation','public');
            }
            $formation->save();
            foreach($request->prices as $price){
                $prix= new Price();
                $prix->type=$price["type"];
                $prix->price= $price["price"];
                $formation->prices()->save($prix);
            }
            return redirect()->route('formation.details', $formation->id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $authStudentId = auth()->user()->roleable_id;
        $formation=Formation::find($id);
        $canUpdate= Gate::allows('update', $formation);
        $canInteract= Gate::allows('interact', [Inscription::class, $formation]);
        $canAdministrate= Gate::allows('administrate', Admin::class);
        if($canUpdate || $canInteract || $canAdministrate){
            $formation= Formation::with('cycle','filiere', 'annee', 'matiere', 'chapitres.cours.video', 'chapitres.cours.ressources', 'chapitres.cours.questions', 'chapitres.cours.quiz', 'teacher.user', 'ressources')->find($id);
                $formation->chapitres->each(function($chapitre) use ($authStudentId) {
                $chapitre->cours->each(function($cour) use ($authStudentId) {
                    if($cour->soumissions()->where('student_id', $authStudentId)->exists()){
                        $cour->isSubmitted = true ;
                    }
                    if($cour->quiz()->exists()){
                        if($cour->quiz->soumissions()->where('student_id', $authStudentId)->exists())
                            $cour->quiz->isSubmitted = true;
                    }
                    
                    $cour->ressources->each(function($ressource) use ($authStudentId) {
                        if($ressource->soumissions()->where('student_id', $authStudentId)->exists())
                            $ressource->isSubmitted= true;
                    });
                });
            });
            
        }
        else {
            $formation = Formation::with(['cycle', 'filiere', 'annee', 'matiere', 'teacher.user', 'chapitres.cours'])->find($id);

// Charger les vidéos et les ressources pour les cours gratuits
            $formation->chapitres->each(function ($chapitre) {
                $chapitre->cours->filter(function ($cours) {
                    return $cours->gratuit;
                })->each(function ($cours) {
                    $cours->load('video', 'ressources');
                });
            });
            //dd($formation);
        }
        $stars5= Formation::find($id)->avis()->where('valeur', 5)->get();
        $stars4= Formation::find($id)->avis()->where('valeur', 4)->get();
        $stars3= Formation::find($id)->avis()->where('valeur', 3)->get();
        $stars2= Formation::find($id)->avis()->where('valeur', 2)->get();
        $stars1= Formation::find($id)->avis()->where('valeur', 1)->get();
        $myComment= Avis::where('user_id', auth()->user()->id)->where('aviable_id', $formation->id)->first();
        
        return Inertia::render('Formation/Formation', [
            'formation'=> $formation,
            'canUpdate'=> $canUpdate,
            'canInteract'=>$canInteract ,
            'stars5'=> $stars5,
            'stars4'=> $stars4,
            'stars3'=> $stars3,
            'stars2'=> $stars2,
            'stars1'=> $stars1,
            'myComment'=> $myComment
        ]);
            
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation= Formation::with(['matiere', 'cycle', 'filiere', 'annee', 'matiere', 'prices'])->find($id);
        if(Gate::allows('update', $formation)){
            $cycles= Cycle::get();
            $matieres= Matiere::get();
            return Inertia::render('Formation/EditDetails', ['cycles'=>$cycles, 'matieres'=>$matieres, 'formation'=>$formation]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $formation= Formation::find($id);
        if(Gate::allows('update', $formation)){
            $formation->title= $request->nom;
            $formation->teacher_id= auth()->user()->roleable_id;
            $formation->annee_id= $request->annee['id'];
            $formation->filiere_id= $request->filiere['id'];
            $formation->cycle_id= $request->cycle['id'];
            $formation->matiere_id= $request->matiere['id'];
            $formation->description= $request->description;
            $formation->a_apprendre= $request->a_apprendre;
            $formation->prerequis= $request->prerequis;
            $formation->a_propos= $request->a_propos;
            if($request->file("photo_url")){
                $formation->photo_url=$request->file('photo_url')->store('formation','public');
            }
            $formation->update();
            if($request->old_prices){
                foreach($request->old_prices as $price){
                    $prix= Price::find($price['id']);
                    $prix->is_active=$price["is_active"];
                    $prix->update();
                }
            }
            
            foreach($request->prices as $price){
                if($price["type"] && $price["price"]){
                    $prix= new Price();
                    $prix->type=$price["type"];
                    $prix->price= $price["price"];
                    $formation->prices()->save($prix);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation= Formation::find($id);
        if(Gate::allows('delete', $formation)){
            $formation->delete();
        }
    }

    public function enable(Request $request){
        if(Gate::allows('administrate', Admin::class)){
            $formation= Formation::find($request->formation_id);
            $formation->is_valide= true;
            $formation->update();
            Mail::to($formation->teacher->user->email)->send(new FormationValidation($request->wrong_msg));
        }
        
    }
    public function disable(Request $request){
        if(Gate::allows('administrate', Admin::class)){
            $formation= Formation::find($request->formation_id);
            $formation->is_valide= false;
            $formation->update();
            Mail::to($formation->teacher->user->email)->send(new FormationDesactivation($request->wrong_msg));
        }
        
    }
}
