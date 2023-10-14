<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public function commentaireable(){
        return $this->morphTo();
    }
    public function avis(){
        return $this->belongsTo(Avis::class);
    }
}
