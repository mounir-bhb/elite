<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    public function ressourceable(){
        return $this->morphTo();
    }

    public function soumissions(){
        return $this->morphMany(Soumission::class, 'soumissionable');
    }
}
