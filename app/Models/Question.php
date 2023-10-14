<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $with= ['reponses'];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function reponses(){
        return $this->hasMany(QuizReponse::class);
    }
}
