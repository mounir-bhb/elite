<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $with= ['questions', 'quizMaps'];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function quizable(){
        return $this->morphTo();
    }

    public function soumissions(){
        return $this->morphMany(Soumission::class, 'soumissionable');
    }

    public function quizMaps(){
        return $this->hasMany(QuizMap::class);
    }
}
