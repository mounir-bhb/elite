<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumSujet extends Model
{
    use HasFactory;

    protected $with= ['user', 'reponses'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /* public function formation(){
        return $this->belongsTo(Formation::class);
    }

    public function cour(){
        return $this->belongsTo(Cour::class);
    } */
    public function reponses(){
        return $this->morphMany(Reponse::class, 'reponseable');
    }

}
