<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function cour(){
        return $this->belongsTo(Cour::class);
    }

    public function quiz(){
        return $this->morphOne(Quiz::class, 'quizable');
    }
}
