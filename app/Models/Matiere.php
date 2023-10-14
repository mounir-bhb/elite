<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = ucfirst($value);
    }

    public function formations(){
        return $this->hasMany(Formation::class);
    }
}
