<?php

use App\Http\Controllers\Administration\CycleController;
use App\Http\Controllers\Administration\DashboardController;
use App\Http\Controllers\Administration\MatiereController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\FormationAvisController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\Roles\StudentController;
use App\Http\Controllers\Roles\TeacherController;
use App\Http\Controllers\SoumissionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use App\Models\Cycle;
use App\Models\Formation;
use Google\Analytics\Data\V1alpha\Row;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $formations= Formation::with('cycle','filiere', 'annee', 'matiere', 'teacher.user')->where('is_valide', true)
    ->latest()
    ->take(10)
    ->get();
    return Inertia::render('Acceuil', ['formations' => $formations]);
});

Route::get('/dashboard', function () {
    $formations= Formation::with('cycle','filiere', 'annee', 'matiere', 'teacher.user')->where('is_valide', true)
    ->latest()
    ->take(10)
    ->get();
    return Inertia::render('Acceuil', ['formations' => $formations]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create', function(){
        $cycles= Cycle::get();
        return Inertia::render('NewRole', ['cycles'=> $cycles]);
    })->name('create.user');
    Route::post('teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::post('student', [StudentController::class, 'store'])->name('student.store');
    Route::put('teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::put('student/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::resource('cycle', CycleController::class);
    Route::resource('matiere', MatiereController::class);
    Route::resource('formation', FormationController::class);
    Route::resource('chapitre', ChapitreController::class);
    Route::resource('cour', CourController::class);
    Route::post('inscription', [InscriptionController::class, 'inscription'])->name('inscription');
    Route::post('quiz-inscription', [InscriptionController::class, 'quizInscription'])->name('quiz.inscription');
    Route::get('teacher/formations', [FormationController::class, 'teacherFormations'])->name('teacher.Formations');
    Route::get('student/formations', [FormationController::class, 'studentFormations'])->name('student.Formations');
    Route::post('ressource/{id}', [RessourceController::class, 'store'])->name('ressource.store');
    Route::delete('ressource/{id}', [RessourceController::class, 'delete'])->name('ressource.destroy');
    Route::get('administration', [DashboardController::class, 'index'])->name('administration');
    Route::post('inscription-validation', [InscriptionController::class, 'validation'])->name('inscription.validation');
    Route::post('refuser-inscription', [InscriptionController::class, 'inscriptionRefus'])->name('inscription.refus');
    Route::post('quiz-inscription-validation', [InscriptionController::class, 'quizValidation'])->name('quiz.inscription.validation');
    Route::post('quiz-inscription-refus', [InscriptionController::class, 'refuserQuizInscription'])->name('quiz.inscription.refus');
    Route::post('tests-price', [QuizController::class, 'quizPrices'])->name('quiz.prices');
});
Route::resource('quiz', QuizController::class);
Route::get('formation/{id}/details', [FormationController::class, 'details'])->name('formation.details');
Route::post('/upload-chunk', [VideoController::class, 'uploadChunk']);
Route::post('/merge-file', [VideoController::class, 'mergeChunks']);
Route::get('quiz-map', function(){
    return Inertia::render('Quiz/QuizMap');
});
Route::get('forum/{formation}/create/{cour}', [ForumController::class, 'create'])->name('forum.create');
Route::post('forum', [ForumController::class, 'store'])->name('forum.store');
Route::post('question', [QuestionController::class, 'questionCour'])->name('question.cour');
Route::post('reponse', [QuestionController::class, 'reponseCour'])->name('reponse.cour');
Route::post('sub-reponse', [QuestionController::class, 'reponse'])->name('reponse');
Route::post('like', [QuestionController::class, 'like'])->name('store.like');
Route::delete('like/{like}', [QuestionController::class, 'deleteLike'])->name('delete.like');
Route::post('valider/reponse', [QuestionController::class, 'valider'])->name('valider.reponse');
Route::post('annule/validation', [QuestionController::class, 'annuleValidation'])->name('valideation.annule');
Route::post('quiz/{id}/create/{type}', [QuizController::class, 'store'])->name('store.quiz');
Route::post('avis', [FormationAvisController::class, 'store'])->name('store.avis');
Route::post('cour/soumission', [SoumissionController::class, 'courSoumission'])->name('cour.soumission');
Route::post('soumission/ressource', [SoumissionController::class, 'ressourceSoumission'])->name('ressource.soumission');
Route::post('quiz/soumission', [SoumissionController::class, 'quizSoumission'])->name('quiz.soumission');
Route::post('reponse/forum', [QuestionController::class, 'reponseForum'])->name('reponse.forum');
Route::get('forum', [ForumController::class, 'index'])->name('forum.index');
Route::resource('test', TestController::class);
Route::get('create/{test}/level', [TestController::class, 'createLevel'])->name('create.level');
Route::post('quiz/{id}/store', [QuizController::class, 'storeQuizMap'])->name('store.map');
Route::get('acceuil', function(){
    $formations= Formation::with('cycle','filiere', 'annee', 'matiere', 'teacher.user')->where('is_valide', true)
    ->latest()
    ->take(10)
    ->get();
    return Inertia::render('Acceuil', ['formations' => $formations]);
})->name('acceuil');
Route::post('paiement', [DashboardController::class, 'paiement'])->name('paiement');
Route::put('enable-formation', [FormationController::class, 'enable'])->name('formation.enable');
Route::put('disable-formation', [FormationController::class, 'disable'])->name('formation.disable');
//Route::post('question', [QuestionController::class, ])->name('question.cour');
require __DIR__.'/auth.php';
