<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    public function chapitre(){
        return $this->belongsTo(Chapitre::class);
    }

    public function video(){
        return $this->hasOne(Video::class);
    }

    public function forumSujets(){
        return $this->hasMany(ForumSujet::class);
    }

    public function ressources(){
        return $this->morphMany(Ressource::class, 'ressourceable');
    }

    public function quiz(){
        return $this->morphOne(Quiz::class, 'quizable');
    }

    public function commentaire(){
        return $this->morphOne(Commentaire::class, 'commentaireable');
    }

    public function soumissions(){
        return $this->morphMany(Soumission::class, 'soumissionable');
    }
    
    public function questions(){
        return $this->hasMany(CourQuestion::class);
    }
}
