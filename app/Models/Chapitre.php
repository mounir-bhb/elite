<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;

    public function formation(){
        return $this->belongsTo(Formation::class);
    }

    public function cours(){
        return $this->hasMany(Cour::class);
    }

    public function ressources(){
        return $this->morphMany(Ressource::class, 'ressourceable');
    }
}
