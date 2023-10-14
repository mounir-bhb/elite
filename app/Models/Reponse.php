<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $with= ['user', 'reponses', 'likes'];

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
        return $this->morphMany(Reponse::class, 'reponseable');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
