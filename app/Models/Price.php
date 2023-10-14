<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /* public function student(){
        return $this->belongsTo(Student::class);
    } */

    public function priceable(){
        return $this->morphTo();
    }
    public function inscriptions(){
        return $this->hasMany(Inscription::class);
    }
    public function quizInscription(){
        return $this->hasMany(QuizInscription::class);
    }
}
