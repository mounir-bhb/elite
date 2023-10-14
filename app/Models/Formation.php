<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function annee(){
        return $this->belongsTo(Annee::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }
    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }

    public function chapitres(){
        return $this->hasMany(Chapitre::class);
    }

    /* public function forumSujets(){
        return $this->hasMany(ForumSujet::class);
    } */

    public function avis(){
        return $this->morphMany(Avis::class, 'aviable');
    }

    public function ressources(){
        return $this->morphMany(Ressource::class, 'ressourceable');
    }

    public function commentaires(){
        return $this->morphMany(Commentaire::class, 'commentaireable');
    }

    public function inscriptions(){
        return $this->hasMany(Inscription::class);
    }

    public function prices(){
        return $this->morphMany(Price::class, 'priceable');
    }
}
