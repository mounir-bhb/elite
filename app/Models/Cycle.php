<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = ucfirst($value);
    }

    protected $with= ['annees', 'filieres'];

    public function filieres(){
        return $this->hasMany(Filiere::class);
    }

    public function annees(){
        return $this->hasMany(Annee::class);
    }
    public function formations(){
        return $this->hasMany(Formation::class);
    }
}
