<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = ucfirst($value);
    }

    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function formations(){
        return $this->hasMany(Formation::class);
    }
}
