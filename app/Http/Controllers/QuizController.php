<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Cour;
use App\Models\Cycle;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\Matiere;
use App\Models\Price;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizMap;
use App\Models\QuizReponse;
use App\Models\Reponse;
use App\Models\Test;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles= Cycle::with('filieres', 'annees')->get();
        $matieres= Matiere::all();
        $tests= Test::with('matiere:id,nom', 'quizzes')->get();
        $prices= Price::where('priceable_type', null)->get();
        /* $test->quizzes->each(function ($quiz) use ($authStudentId){
            if($quiz->soumissions()->where('student_id', $authStudentId)->exists()){
                $quiz->isSubmitted = true ;
            }
        }); */
        
        if(auth()->user()){
            $authStudentId = auth()->user()->roleable_id;
            $tests->each(function($test) use ($authStudentId){
                $perm_test= $test;
                $perm_test->quizzes->each(function ($quiz) use ($authStudentId){
                    if($quiz->soumissions()->where('student_id', $authStudentId)->exists()){
                        $quiz->isSubmitted = true ;
                    }
                });
                $test->submitted_len= $perm_test->quizzes->where('isSubmitted', true)->count();
            });
        }

        $canInscrire= Gate::allows('createQuiz', Inscription::class);

        return Inertia::render('Quiz/QuizIndex', [
            'cycles'=> $cycles,
            'matieres'=>$matieres,
            "tests"=>$tests,
            'prices'=>$prices,
            'canInscrire'=> $canInscrire
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
            return Inertia::render('Quiz/CreateQuiz');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id, $parent)
    {
            $quiz= new Quiz();
            $par= null;
            if($parent=='cour'){
                $formation= Formation::find($request->formation);
                //$this->authorize('update', $formation);
                if(Gate::allows('update', $formation)){
                    $par= Cour::find($id);
                    //$quiz->niveau= $request->niveau;
                    $par->quiz()->save($quiz);
                    foreach($request->questions as $q){
                        $question= new Question();
                        $question->contenu= $q['contenu'];
                        $question->quiz_id= $quiz->id;
                        $question->save();
                        foreach($q['reponses'] as $r){
                            $reponse= new QuizReponse();
                            $reponse->contenu= $r['contenu'];
                            $reponse->is_true= $r['is_true'];
                            $question->reponses()->save($reponse);
                            //$reponse->save();
                        }
                    }
                }
                
            }
            else if($parent=='test'){
                /* $this->authorize('admnistrate', Admin::class); */
                if(Gate::allows('administrate', Admin::class)){
                    $par= Test::find($id);
                    $quiz->niveau= $request->niveau;
                    $par->quizzes()->save($quiz);
                    foreach($request->questions as $q){
                        $question= new Question();
                        $question->contenu= $q['contenu'];
                        $question->quiz_id= $quiz->id;
                        $question->save();
                        foreach($q['reponses'] as $r){
                            $reponse= new QuizReponse();
                            $reponse->contenu= $r['contenu'];
                            $reponse->is_true= $r['is_true'];
                            $question->reponses()->save($reponse);
                            //$reponse->save();
                        }
                    }
                    if($parent=='test')
                        return redirect()->route('create.level', [$par]);
                }
                
            }
            
            
            //$quiz->save();
            
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->user()){
            $authStudentId = auth()->user()->roleable_id;
            $test= Test::with('quizzes')->find($id);
            $canPractice= Gate::allows('practice', Inscription::class);
            $submitted_len=null;
            if($canPractice || Gate::allows('administrate', Admin::class)){
                $test->quizzes->each(function ($quiz) use ($authStudentId){
                    if($quiz->soumissions()->where('student_id', $authStudentId)->exists()){
                        $quiz->isSubmitted = true ;
                    }
                });
                $submitted_len= $test->quizzes->where('isSubmitted', true)->count();
            }
            else {
                $test = Test::with(['quizzes' => function ($query) {
                    $query->orderBy('id', 'asc')->first();
                }])->find($id);
            }
            
            
            return Inertia::render('Quiz/Test', ['test'=>$test, 'submitted_len'=>$submitted_len, 'canPractice'=> $canPractice]);
        }
        else{
            /* $test= Test::with('quizzes')->find($id); */
            $test = Test::with(['quizzes' => function ($query) {
                $query->orderBy('id', 'asc')->first();
            }])->find($id);
            return Inertia::render('Quiz/Test', ['test'=>$test]);
        }
        
        
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function storeQuizMap(Request $request, $id){
        if(!Gate::allows('administrate', Admin::class))
            abort(403);
        else{
            $par= Test::find($id);
            $quiz= new Quiz();
            $quiz->niveau= $request->niveau;
            $par->quizzes()->save($quiz);
            foreach($request->questions as $q){
                $map= new QuizMap();
                $map->question= $q['question'];
                $map->reponse= $q['countries'];
                $map->quiz_id= $quiz->id;
                $map->save();
            }
        }
        
        
        //return redirect()->route('create.level', [$id]);
    }
    
    public function quizPrices(Request $request){
        foreach($request->old_prices as $price){
            $prix= Price::find($price['id']);
            $prix->is_active=$price["is_active"];
            
            $prix->update();
        }
        foreach($request->new_prices as $price){
            $prix= new Price();
            $prix->type=$price["type"];
            $prix->price= $price["price"];
            $prix->save();
            //$formation->prices()->save($prix);
        }

    }
}
