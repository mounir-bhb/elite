<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $with= ['commentaire', 'user.roleable'];

    public function aviable(){
        return $this->morphTo();
    }

    public function commentaire(){
        return $this->hasOne(Commentaire::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
