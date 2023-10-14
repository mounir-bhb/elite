<?php

namespace App\Policies;

use App\Models\Formation;
use App\Models\Inscription;
use App\Models\QuizInscription;
use App\Models\User;

class InscriptionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function createFormation(User $user, Formation $formation){
        $inscription= Inscription::where('formation_id', $formation->id)
            ->where('student_id', $user->roleable_id)
            ->exists();
        return $user->roleable_type == 'App\Models\Student' && !$inscription;
    }
    public function createQuiz(User $user){
        $inscription= QuizInscription::where('student_id', $user->roleable_id)
            ->exists();
        return $user->roleable_type == 'App\Models\Student' && !$inscription;
    }

    public function interact(User $user, Formation $formation){
        $inscription= Inscription::where('formation_id', $formation->id)
            ->where('student_id', $user->roleable_id)
            ->where('valide', true)
            ->exists();
        return $user->roleable_type == 'App\Models\Student' && $inscription;
    }
    public function practice(User $user){
        $inscription= QuizInscription::where('student_id', $user->roleable_id)
            ->where('is_valide', true)
            ->exists();
        return $user->roleable_type == 'App\Models\Student' && $inscription;
    }
}
