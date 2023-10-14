<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Monolog\Level;

class Test extends Model
{
    use HasFactory;

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    public function quizzes(){
        return $this->morphMany(quiz::class, 'quizable');
    }

    public function levels(){
        return $this->hasMany(Level::class);
    }

    public function soumission(){
        return $this->morphMany(Soumission::class, 'soumissionable');
    }
}
