<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourReponse extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reponseable(){
        return $this->morphTo();
    }

    /* public function question(){
        return $this->belongsTo(CourQuestion::class);
    } */

    public function reponses(){
        return $this->morphMany(CourReponse::class, 'reponseable');
    }
}
