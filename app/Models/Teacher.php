<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function formations(){
        return $this->hasMany(Formation::class);
    }

    public function user(){
        return $this->morphOne(User::class, 'roleable');
    }

    public function avis(){
        return $this->morphOne(Avis::class, 'aviable');
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
}
