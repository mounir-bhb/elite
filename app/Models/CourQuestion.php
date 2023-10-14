<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourQuestion extends Model
{
    use HasFactory;

    protected $with= ['user', 'reponses'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reponses(){
        return $this->morphMany(Reponse::class, 'reponseable');
    }
}
