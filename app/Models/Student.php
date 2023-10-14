<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user(){
        return $this->morphOne(User::class, 'roleable');
    }
    public function soumissions(){
        return $this->hasMany(Soumission::class);
    }

    public function inscrtiptions(){
        return $this->hasMany(Inscription::class);
    }
}
